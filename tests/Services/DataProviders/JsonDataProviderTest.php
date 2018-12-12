<?php


namespace App\Tests\Services\DataProviders;


use App\Lib\Exceptions\DataProviderException;
use App\Lib\Sources;
use App\Services\DataProviders\Clients\GuzzleClient;
use App\Services\DataProviders\Factories\ProviderConfig;
use App\Services\DataProviders\JsonDataProvider;
use PHPUnit\Framework\TestCase;

class JsonDataProviderTest extends TestCase
{
    /** @dataProvider dataProvider */
    public function testGetData($json, $expected, $exception = null)
    {
        $client = $this->createMock(GuzzleClient::class);
        $client->expects($this->once())->method('execute')->willReturn($json);

        $config = new ProviderConfig();
        $config->setSource(Sources::MDS_VOICE);
        $config->setUrl('fakeUrl');

        $mappings = [
            Sources::MDS_VOICE => 'http://ice.planeset.ru:8000/mds_voice.mp3',
            Sources::MDS_MUSIC => 'http://ice.planeset.ru:8000/mds.mp3',
        ];

        $provider = new JsonDataProvider($client, $mappings);
        $provider->setConfig($config);

        if ($exception) {
            $this->expectException($exception);
        }
        $actual = $provider->getData();
        $this->assertSame($expected, $actual);

    }

    public function testNoConfig()
    {
        $client = $this->createMock(GuzzleClient::class);
        $provider = new JsonDataProvider($client, []);
        $this->expectException(DataProviderException::class);
        $this->expectExceptionMessage('There is no config for current DataProvider.');
        $provider->getData();
    }

    public function dataProvider()
    {
        $expected = [
            'audio_info' => 'channels=2;samplerate=44100;bitrate=128',
            'channels' => 2,
            'genre' => 'various',
            'listener_peak' => 29,
            'listeners' => 11,
            'listenurl' => 'http://ice.planeset.ru:8000/mds_voice.mp3',
            'samplerate' => 44100,
            'server_description' => 'Трансляции Модель Для  Сборки - голос',
            'server_name' => 'Модель для сборки - голос',
            'server_type' => 'audio/mpeg',
            'stream_start' => 'Sat, 17 Nov 2018 17:58:38 +0300',
            'stream_start_iso8601' => '2018-11-17T17:58:38+0300',
            'title' => 'Уильям Тенн - Мускулинистский переворот',
            'dummy' => null,
        ];

        return [
            ['', '', DataProviderException::class],
            ['{sseejkj', '', DataProviderException::class],
            ['{"icestats":{"admin":"zalex@zalex.com.ua","host":"ice.planeset.ru","location":"Andibadra","server_id":"Icecast 2.4.0","server_start":"Sat, 17 Nov 2018 17:57:45 +0300","server_start_iso8601":"2018-11-17T17:57:45+0300","source":[{"audio_info":"channels=2;samplerate=44100;bitrate=128","channels":2,"genre":"various","listener_peak":14,"listeners":1,"listenurl":"http://ice.planeset.ru:8000/mds.mp3","samplerate":44100,"server_description":"Трансляции Модель Для  Сборки - музыка","server_name":"Модель для сборки - музыка","server_type":"audio/mpeg","stream_start":"Sat, 17 Nov 2018 17:58:34 +0300","stream_start_iso8601":"2018-11-17T17:58:34+0300","title":"Androcell - Ganja Baba","dummy":null},{"audio_info":"channels=2;samplerate=44100;bitrate=128","channels":2,"genre":"various","listener_peak":29,"listeners":11,"listenurl":"http://ice.planeset.ru:8000/mds_voice.mp3","samplerate":44100,"server_description":"Трансляции Модель Для  Сборки - голос","server_name":"Модель для сборки - голос","server_type":"audio/mpeg","stream_start":"Sat, 17 Nov 2018 17:58:38 +0300","stream_start_iso8601":"2018-11-17T17:58:38+0300","title":"Уильям Тенн - Мускулинистский переворот","dummy":null}]}}', $expected],
        ];
    }

}