<?php


namespace App\Services\DataProviders\Factories\Config;


use App\Services\DataProviders\Factories\ProviderConfigInterface;

interface FactoryConfigInterface
{
    /**
     * @return ProviderConfigInterface[]
     */
    public function getConfig(): array;
}