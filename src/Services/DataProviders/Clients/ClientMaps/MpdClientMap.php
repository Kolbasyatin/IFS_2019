<?php


namespace App\Services\DataProviders\Clients\ClientMaps;


use App\Services\DataProviders\Clients\ClientInterface;
use App\Services\DataProviders\Clients\MpdClient;
use App\Services\DataProviders\Clients\MPDConnection;
use App\Services\DataProviders\Factories\ProviderConfigInterface;

class MpdClientMap extends AbstractDataClientMap
{

    protected const TYPE = 'MPD';

    protected function createClient(ProviderConfigInterface $config): ClientInterface
    {
        $connection = new MPDConnection($config->getUrl(), $config->getPassword());

        return new MpdClient($connection);
    }

}