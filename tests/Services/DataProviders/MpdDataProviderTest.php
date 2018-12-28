<?php


namespace App\Tests\Services\DataProviders;


use App\Services\DataProviders\Clients\MpdClient;
use App\Services\DataProviders\Factories\ProviderConfig;
use App\Services\DataProviders\MpdDataProvider;
use App\Services\Informer;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MpdDataProviderTest extends WebTestCase
{
    public function testGetData()
    {
        self::bootKernel();
        $service = self::$container->get(Informer::class);
        $data = $service->getInfo('voice', 'mpd');
        $a = 'b';
//        $config = $this->createConfig();
//        $service->setConfig($config);
//        $actual = $service->getData();
//        $client = $this->createMock(MpdClient::class);
//        $client->expects($this->once())->method('execute')->willReturn($json);
//
//        $clientMap = $this->createMock(JsonClientMap::class);
//        $clientMap->expects($this->once())->method('getClient')->willReturn($client);
//
//        $mappings = [
//            Sources::MDS_VOICE => 'http://ice.planeset.ru:8000/mds_voice.mp3',
//            Sources::MDS_MUSIC => 'http://ice.planeset.ru:8000/mds.mp3',
//        ];
//        $provider = new JsonDataProvider($clientMap, $mappings);
//        if ($exception) {
//            $this->expectException($exception);
//        }
//        $actual = $provider->getData(Sources::MDS_VOICE);
//
//        $this->assertSame($expected, $actual);
    }

    private function createConfig()
    {
        $config = new ProviderConfig();
        $config
            ->setPassword('Wkm2wD')
            ->setUrl('ice.planeset.ru:6601')
        ;

        return $config;
    }
}