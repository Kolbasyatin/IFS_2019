<?php


namespace App\Tests\Services;


use App\Lib\DataProviderTypes;
use App\Lib\Info\SourceInfo;
use App\Services\DataProviders\Clients\ClientMaps\MpdClientMap;
use App\Services\DataProviders\Clients\MpdClient;
use App\Services\Informer;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class InformerMpdTest extends WebTestCase
{
    public function testGetInfo()
    {
        self::bootKernel();
        $mpdClient = self::$container->get(MpdClientMap::class)->getClient('test_voice');
        /** @var MpdClient $mpdClient */
        $mpdClient->clear();
        $listAll = $mpdClient->listall();

        $files = array_map(
            static function ($file) {
                return str_replace('file: ', '', $file);
            },
            $listAll
        );

        /** @var MpdClient $mpdClient */
        foreach ($files as $file) {
            $mpdClient->add("\"$file\"");
        }

        $result = $mpdClient->play();
        $this->assertEmpty($result);
        $informer = self::$container->get(Informer::class);
        /** @var SourceInfo $actual */
        /** @noinspection PhpUnhandledExceptionInspection */
        $actual = $informer->getInfo('test_voice', DataProviderTypes::MPD_TYPE);
        $mpdClient->stop();
        $mpdClient->clear();


        $this->assertEquals('test_voice', $actual->getSource());
        $this->assertEquals('online', $actual->getStatus());

        $this->assertNotEmpty($actual->getSongName());
        $this->assertNotEmpty($actual->getNextSongName());
        $this->assertNotEmpty($actual->getStartTime());
        $this->assertNotEmpty($actual->getEndTime());
        $this->assertTrue($actual->getStartTime() < $actual->getEndTime());
    }

}