<?php


namespace App\Services\DataProviders\Clients;


use App\Lib\Exceptions\DataClientException;

interface ClientInterface
{
    /**
     * @return mixed
     * @throws DataClientException
     */
    public function execute();
}