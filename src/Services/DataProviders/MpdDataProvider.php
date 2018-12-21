<?php


namespace App\Services\DataProviders;


use App\Lib\DataProviderTypes;
use App\Lib\Exceptions\DataProviderException;
use App\Services\DataProviders\Clients\MpdClient;

/**
 * Class MpdDataProvider
 * @package App\Services\DataProviders
 */
class MpdDataProvider implements DataProviderInterface
{

    /** @var MpdClient */
    private $client;

    /**
     * MpdDataProvider constructor.
     * @param MpdClient $client
     */
    public function __construct(MpdClient $client)
    {
        $this->client = $client;
    }

    use ConfigAwareDataProviderTrait;

    /**
     * @return
     * @throws \App\Lib\Exceptions\DataClientException
     * @throws DataProviderException
     */
    public function getData(): array
    {
        if (!$this->config) {
            throw new DataProviderException('There is no config for current DataProvider.');
        }

        $this->client->setConfig(
                $this->config->getUrl(),
                $this->config->getLogin(),
                $this->config->getPassword()
            );

        return $this->client->getStatus();
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return DataProviderTypes::MPD_TYPE;
    }

}