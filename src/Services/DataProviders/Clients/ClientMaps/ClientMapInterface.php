<?php


namespace App\Services\DataProviders\Clients\ClientMaps;


use App\Services\DataProviders\Clients\ClientInterface;

interface ClientMapInterface
{
    public function getClient(string $sourceName): ClientInterface;
}