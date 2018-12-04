<?php


namespace App\Services\DataProviders;


use App\Lib\Info\ProviderTypeInterface;

class DataProviderFactory
{
    public function create(ProviderTypeInterface $providerFactoryQuery): DataProviderInterface
    {
        $type = $providerFactoryQuery->getDataProviderType();
    }
}