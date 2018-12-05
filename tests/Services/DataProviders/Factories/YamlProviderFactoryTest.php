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
        $sources = [Sources::MDS_VOICE, Sources::MDS_MUSIC];
        foreach ($sources as $source) {
            $actual = self::$container->get(YamlProviderFactory::class)->create($source);
            $config = self::$container->getParameter('sources')['sources'];
            $actualConfig = array_filter(
                $config,
                function ($element) use ($source){
                    return $element['name'] === $source;
                }
            );
            $actualConfig = reset($actualConfig)['informer'];
            $this->assertEquals($actualConfig['type'], $actual->getType());
        }

    }

    public function testFailCreate()
    {
        self::bootKernel();
        $this->expectException(FactoryDataProviderException::class);
        self::$container->get(YamlProviderFactory::class)->create('error source');
    }
}