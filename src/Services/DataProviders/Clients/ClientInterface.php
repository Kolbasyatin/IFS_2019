<?php


namespace App\Services\DataProviders\Clients;


use App\Lib\Exceptions\DataClientException;

interface ClientInterface
{
    /**
     * @param string $address
     * @param string $login
     * @param string $password
     * @return mixed
     * @throws DataClientException
     */
    public function execute(string $address, string $login, string $password);
}