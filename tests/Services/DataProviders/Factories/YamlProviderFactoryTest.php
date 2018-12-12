<?php


namespace App\Tests\Services\DataProviders\Factories;


use App\Lib\Exceptions\FactoryDataProviderException;
use App\Lib\Sources;
use App\Services\DataProviders\Factories\YamlProviderFactory;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class YamlProviderFactoryTest extends WebTestCase
{
    public function testCreate()
    {
        self::bootKernel();
        $sources = [
            Sources::MDS_VOICE => 'mpd',
            Sources::MDS_VOICE => 'json',
            Sources::MDS_MUSIC => 'mpd',
            Sources::MDS_MUSIC => 'json',
        ];
        foreach ($sources as $source => $provider) {
            $actual = self::$container->get(YamlProviderFactory::class)->create($source, $provider);
            $this->assertEquals($provider, $actual->getType());
        }

    }

    public function testFailCreate()
    {
        self::bootKernel();
        $this->expectException(FactoryDataProviderException::class);
        self::$container->get(YamlProviderFactory::class)->create('error source');
    }
}