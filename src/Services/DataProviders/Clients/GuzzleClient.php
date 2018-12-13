<?php


namespace App\Services\DataProviders\Clients;


use App\Lib\Exceptions\DataClientException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class GuzzleClient implements ClientInterface
{

    private $client;

    /**
     * GuzzleClient constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    public function execute(string $address, string $login, string $password): string
    {
        try {
            $response = $this->client->get($address);
            if ($response->getStatusCode() !== 200) {
                throw new DataClientException(sprintf('Answer client status code is %d', $response->getStatusCode()));
            }
        } catch (RequestException $e) {
            throw new DataClientException($e->getMessage());
        }

        return $response->getBody()->getContents();
    }

}