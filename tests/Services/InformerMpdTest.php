<?php


namespace App\Tests\Services;


use App\Lib\Sources;
use App\Services\DataProviders\Clients\ClientMaps\MpdClientMap;
use App\Services\DataProviders\Clients\MpdClient;
use App\Services\Informer;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class InformerMpdTest extends WebTestCase
{
    public function testGetInfo()
    {
        self::bootKernel();
        /** @var MpdClient $mpdClient */
        $mpdClient = self::$container->get(MpdClientMap::class)->getClient('test_voice');
//        $aaa = $mpdClient->lsinfo();
//        $mpdClient->listplaylistinfo();
//        $informer = self::$container->get(Informer::class);
//        $result = $informer->getInfo(Sources::MDS_VOICE);

    }

}