<?php


namespace App\Tests\Services;


use App\Entity\Source;
use App\Lib\DataProviderTypes;
use App\Lib\Exceptions\DataClientException;
use App\Lib\Info\SourceInfo;
use App\Lib\Sources;
use App\Services\DataProviders\Clients\ClientMaps\JsonClientMap;
use App\Services\DataProviders\Clients\GuzzleClient;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Services\Informer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class InformerJsonTest extends WebTestCase
{

    public function testGetInfoSuccessful(): void
    {

        $this->jsonInit($this->getJsonData());

        /** @var SourceInfo $actual */
        $actual = static::$container->get(Informer::class)->getInfo(Sources::MDS_VOICE, DataProviderTypes::JSON_TYPE);
        $this->assertEquals('online', $actual->getStatus());

        /** @var Serializer $serializer */
        $serializer = self::$container->get(SerializerInterface::class);
        $data = $serializer->decode($this->getJsonData(), 'json');
        $data = $data['icestats']['source'][1];

        $this->assertSame($data['title'], $actual->getSongName());
        $this->assertSame($data['listeners'], $actual->getListeners());

    }

    public function testGetInfoErrorSource(): void
    {
        $this->jsonInit('');
        /** @var SourceInfo $actual */
        $actual = static::$container->get(Informer::class)->getInfo(Sources::MDS_VOICE);
        $this->assertEquals('error', $actual->getStatus());
        $this->assertSame('Bad json from client!', $actual->getErrorReason());
    }

    public function testGetClientThrowException(): void
    {
        $mock = $this->createMock(GuzzleClient::class);
        $mock->expects($this->once())->method('execute')->willThrowException(new DataClientException('Error for test.'));
        $this->jsonInit('', $mock);
        /** @var SourceInfo $actual */
        $actual = static::$container->get(Informer::class)->getInfo(Sources::MDS_VOICE);
        $this->assertEquals('error', $actual->getStatus());
        $this->assertEquals('Error for test.', $actual->getErrorReason());
    }

    private function getJsonData(): string
    {
        return '{"icestats":{"admin":"zalex@zalex.com.ua","host":"localhost","location":"Andibadra","server_id":"Icecast 2.4.0","server_start":"Sat, 17 Nov 2018 17:57:45 +0300","server_start_iso8601":"2018-11-17T17:57:45+0300","source":[{"audio_info":"channels=2;samplerate=44100;bitrate=128","channels":2,"genre":"various","listener_peak":14,"listeners":0,"listenurl":"http://localhost:8000/mds.mp3","samplerate":44100,"server_description":"Трансляции Модель Для  Сборки - музыка","server_name":"Модель для сборки - музыка","server_type":"audio/mpeg","stream_start":"Sat, 17 Nov 2018 17:58:34 +0300","stream_start_iso8601":"2018-11-17T17:58:34+0300","title":"Through the Universe - Loungerinium","dummy":null},{"audio_info":"channels=2;samplerate=44100;bitrate=128","channels":2,"genre":"various","listener_peak":29,"listeners":4,"listenurl":"http://localhost:8000/mds_voice.mp3","samplerate":44100,"server_description":"Трансляции Модель Для  Сборки - голос","server_name":"Модель для сборки - голос","server_type":"audio/mpeg","stream_start":"Sat, 17 Nov 2018 17:58:38 +0300","stream_start_iso8601":"2018-11-17T17:58:38+0300","title":"Джордж Мартин - Крест и дракон (Энергия)","dummy":null}]}}';
    }

    private function jsonInit($data, $clientMock = null)
    {
        if (null === $clientMock) {
            $clientMock = $this->createMock(GuzzleClient::class);
            $clientMock->expects($this->once())->method('execute')->willReturn($data);
        }

        $mock = $this->createMock(JsonClientMap::class);
        $mock->expects($this->once())->method('getClient')->willReturn($clientMock);

        static::bootKernel();
        static::$container->set('test.json_client_map', $mock);
    }
}