<?php


namespace App\Services\DataProviders;


use App\Lib\DataProviderTypes;
use App\Services\DataProviders\Clients\ClientMaps\ClientMapInterface;
use App\Services\DataProviders\Clients\ClientMaps\MpdClientMap;

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
        return $this->clientMap->getClient($sourceName)->execute();
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return DataProviderTypes::MPD_TYPE;
    }

}