<?php


namespace App\Tests\Services\DataProviders;


use App\Services\DataProviders\Factories\ProviderConfig;
use App\Services\DataProviders\MpdDataProvider;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MpdDataProviderTest extends WebTestCase
{
    public function testGetData()
    {
        self::bootKernel();
        $service = self::$container->get(MpdDataProvider::class);
        $config = $this->createConfig();
        $service->setConfig($config);
        $actual = $service->getData();
        $a = 'b';
    }

    private function createConfig()
    {
        $config = new ProviderConfig();
        $config
            ->setLogin('login')
            ->setPassword('Wkm2wD')
            ->setUrl('ice.planeset.ru:6601')
        ;

        return $config;
    }
}