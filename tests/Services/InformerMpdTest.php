<?php


namespace App\Tests\Services;


use App\Lib\DataProviderTypes;
use App\Lib\Exceptions\DataClientException;
use App\Lib\Info\SourceInfo;
use App\Services\DataProviders\Clients\ClientMaps\MpdClientMap;
use App\Services\DataProviders\Clients\MpdClient;
use App\Services\Informer;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class InformerMpdTest
 * @package App\Tests\Services
 */
class InformerMpdTest extends WebTestCase
{
    /**
     * @throws DataClientException
     */
    public function testGetInfo()
    {
        self::bootKernel();
        $mpdClient = self::$container->get(MpdClientMap::class)->getClient(InformerTest::TEST_SOURCE_NAME);
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
        $actual = $informer->getInfo(InformerTest::TEST_SOURCE_NAME, DataProviderTypes::MPD_TYPE);
        $mpdClient->stop();
        $mpdClient->clear();


        $this->assertEquals(InformerTest::TEST_SOURCE_NAME, $actual->getSource());
        $this->assertEquals('online', $actual->getStatus());

        $this->assertNotEmpty($actual->getSongName());
        $this->assertNotEmpty($actual->getNextSongName());
        $this->assertNotEmpty($actual->getStartTime());
        $this->assertNotEmpty($actual->getEndTime());
        $this->assertTrue($actual->getStartTime() < $actual->getEndTime());
    }

}