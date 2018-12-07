<?php


namespace App\Tests\Services;


use App\Lib\Info\InfoAnswer;
use App\Lib\Info\InfoQuery;
use App\Services\DataProviders\DataProviderInterface;
use App\Services\Informer;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class InformerTest extends TestCase
{

    /** @var Informer */
    private $service;

    public static function setUpBeforeClass()
    {
        static::bootKernel();
    }

    protected function setUp()
    {
        $this->service = static::$container->get(Informer::class);
    }


    public function testGetInfoSuccessful(): void
    {
        $query = new InfoQuery();
        /** @var InfoAnswer $actual */
        $actual = $this->service->getInfo($query);
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
}