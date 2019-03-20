<?php


namespace App\Services\DataProviders\Clients;


use App\Lib\Exceptions\DataClientException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

/**
 * Class GuzzleClient
 * @package App\Services\DataProviders\Clients
 */
class GuzzleClient implements ClientInterface
{

    /**
     * @var Client
     */
    private $client;

    /** @var  string */
    private $address;

    /**
     * GuzzleClient constructor.
     * @param string $address
     */
    public function __construct(string $address)
    {
        $this->client = new Client();
        $this->address = $address;
    }

    /**
     * @return string
     * @throws DataClientException
     */
    public function execute(): string
    {
        try {
            $response = $this->client->get($this->address);
            if ($response->getStatusCode() !== 200) {
                throw new DataClientException(sprintf('Answer client status code is %d', $response->getStatusCode()));
            }
        } catch (RequestException $e) {
            throw new DataClientException($e->getMessage());
        }

        return $response->getBody()->getContents();
    }

}