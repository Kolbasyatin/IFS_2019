<?php


namespace App\Services\DataProviders;


use App\Lib\Exceptions\DataProviderException;
use App\Services\DataProviders\Factories\ProviderConfigInterface;

interface DataProviderInterface
{
    /**
     * @param string $sourceName
     * @return mixed
     */
    public function getData(string $sourceName): array;

    public function getType(): string;
}