<?php


namespace App\Tests\Services\DataProviders\Factories;


use App\Services\DataProviders\Factories\EntityProviderFactory;
use App\Services\DataProviders\Factories\ProviderFactory;
use App\Services\DataProviders\Factories\ProviderFactoryInterface;
use App\Services\DataProviders\Factories\YamlProviderFactory;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProviderFactoryTest extends WebTestCase
{

    public function testCreateYaml()
    {
        self::bootKernel();
        $type = ProviderFactory::YAML_TYPE;
        $actual = self::$container->get(ProviderFactoryInterface::class);
        if (ProviderFactory::YAML_TYPE === $type) {
            $this->assertInstanceOf(YamlProviderFactory::class, $actual);
        }
        if (ProviderFactory::ENTITY_TYPE === $type) {
            $this->assertInstanceOf(EntityProviderFactory::class, $actual);
        }

    }

}