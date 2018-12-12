<?php


namespace App\Tests\Services;


use App\Lib\Info\InfoAnswer;
use App\Lib\Info\InfoQuery;
use App\Lib\Sources;
use App\Services\DataProviders\Clients\GuzzleClient;
use App\Services\DataProviders\DataProviderInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Services\Informer;

class InformerTest extends WebTestCase
{

//    /** @var Informer */
//    private $service;
//
//    public static function setUpBeforeClass()
//    {
//        static::bootKernel();
//    }

//    protected function setUp()
//    {
//        $this->service = static::$container->get(Informer::class);
//    }

    /** @dataProvider dataProvider */
    public function testGetInfoSuccessful($source): void
    {

        $mock = $this->createMock(GuzzleClient::class);
        static::bootKernel();
        static::$container->set('guzzle.client', $mock);

        $query = new InfoQuery();
        $query->setSource(Sources::MDS_VOICE);
        /** @var InfoAnswer $actual */
        $actual = static::$container->get(Informer::class)->getInfo($query);
        $this->assertEquals('online', $actual->getStatus());

    }

    public function testGetInfoErrorSource(): void
    {
        $query = new InfoQuery();
        /** @var InfoAnswer $actual */
        $actual = $this->service->getInfo($query);
        $this->assertEquals('error', $actual->getStatus());
    }

    public function testGetInfoOffline(): void
    {
        $query = new InfoQuery();
        /** @var InfoAnswer $actual */
        $actual = $this->service->getInfo($query);
        $this->assertEquals('offline', $actual->getStatus());
    }

    private function getService()
    {

    }

    private function createDataProviderMock()
    {
        $dataProviderMock = $this->createMock(DataProviderInterface::class);
    }

    public function dataProvider(): iterable
    {
        yield [Sources::MDS_VOICE];
        yield [Sources::MDS_MUSIC];
        yield ['fakeSource'];
    }
}