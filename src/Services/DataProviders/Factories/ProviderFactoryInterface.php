<?php


namespace App\Services\DataProviders\Factories;


use App\Lib\DataProviderTypes;
use App\Services\DataProviders\DataProviderInterface;

interface ProviderFactoryInterface
{
    public function create(string $sourceName, string $type = DataProviderTypes::JSON_TYPE): DataProviderInterface;
}