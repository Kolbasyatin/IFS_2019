<?php


namespace App\Services\DataProviders\Clients\ClientMaps;


use App\Services\DataProviders\Clients\ClientInterface;
use App\Services\DataProviders\Clients\GuzzleClient;
use App\Services\DataProviders\Factories\ProviderConfigInterface;

/**
 * Class JsonClientMap
 * @package App\Services\DataProviders\Clients\ClientMaps
 */
class JsonClientMap extends AbstractDataClientMap
{
    protected const TYPE = 'JSON';

    protected function createClient(ProviderConfigInterface $config): ClientInterface
    {
        return new GuzzleClient($config->getUrl());
    }


}