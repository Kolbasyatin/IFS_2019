<?php


namespace App\Services\DataProviders\Clients\ClientMaps;


use App\Lib\DataProviderTypes;
use App\Lib\Exceptions\DataClientException;
use App\Services\DataProviders\Clients\ClientInterface;
use App\Services\DataProviders\Factories\Config\FactoryConfigInterface;
use App\Services\DataProviders\Factories\ProviderConfigInterface;

abstract class AbstractDataClientMap implements ClientMapInterface
{

    protected const TYPE = 'abstract';

    /** @var ClientInterface[] */
    protected $clients;

    /**
     * GuzzleMap constructor.
     * @param FactoryConfigInterface $configuration
     */
    public function __construct(FactoryConfigInterface $configuration)
    {
        foreach ($configuration->getConfig() as $config) {
            if ($config->getProviderType() === DataProviderTypes::JSON_TYPE) {
                $this->clients[$config->getSource()->getName()] = $this->createClient($config);
            }
        }
    }

    /**
     * @param string $sourceName
     * @return ClientInterface
     * @throws DataClientException
     */
    public function getClient(string $sourceName): ClientInterface
    {
        $client = $this->clients[$sourceName] ?? null;
        if (!$client) {
            throw new DataClientException(sprintf('No Data client in %s client map.', static::TYPE));
        }

        return $client;
    }

    abstract protected function createClient(ProviderConfigInterface $config): ClientInterface;

}