<?php


namespace App\Services\DataProviders;


use App\Lib\Exceptions\DataProviderException;
use App\Services\DataProviders\Factories\ProviderConfigInterface;

interface DataProviderInterface
{
    /**
     * @return mixed
     * @throws DataProviderException
     */
    public function getData(): array;

    public function setConfig(ProviderConfigInterface $config): DataProviderInterface;

    public function getType(): string;
}