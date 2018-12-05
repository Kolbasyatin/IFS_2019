<?php


namespace App\Services\DataProviders\Factories;


use App\Lib\Exceptions\FactoryDataProviderException;

class YamlProviderFactory extends AbstractProviderFactory
{

    /**
     * @param array $config
     * @return void
     * @throws FactoryDataProviderException
     */
    protected function createProviderConfigs(array $config): void
    {
        $sources = $config['sources'] ?? null;
        if (null === $sources) {
            throw new FactoryDataProviderException('Wrong yaml config in sources description file!');
        }
        try {
            foreach ($sources as $source) {
                $this->providerConfigs[] = ProviderConfig::createInstance(
                    $source['name'],
                    $source['informer']['type'],
                    $source['informer']['url'],
                    $source['informer']['login'],
                    $source['informer']['password']
                );
            }
        } catch (\Exception $e) {
            throw new FactoryDataProviderException('Wrong yaml config in sources description file!');
        }


    }


}