<?php


namespace App\Services\DataProviders;


use App\Lib\DataProviderTypes;
use App\Services\DataProviders\Clients\ClientMaps\ClientMapInterface;
use App\Services\DataProviders\Clients\ClientMaps\MpdClientMap;
use App\Services\DataProviders\Clients\MpdClient;

/**
 * Class MpdDataProvider
 * @package App\Services\DataProviders
 */
class MpdDataProvider implements DataProviderInterface
{

    /** @var ClientMapInterface */
    private $clientMap;

    /**
     * MpdDataProvider constructor.
     * @param MpdClientMap $clientMap
     */
    public function __construct(MpdClientMap $clientMap)
    {
        $this->clientMap = $clientMap;
    }


    /**
     * @param string $sourceName
     * @return array
     * @throws \App\Lib\Exceptions\DataClientException
     */
    public function getData(string $sourceName): array
    {
        /** @var MpdClient $mpdClient */
        $mpdClient = $this->clientMap->getClient($sourceName);

        return $mpdClient->getStatus();
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return DataProviderTypes::MPD_TYPE;
    }

}