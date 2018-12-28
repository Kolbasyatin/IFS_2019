<?php


namespace App\Services\DataProviders;


use App\Lib\Exceptions\DataProviderException;

interface DataProviderInterface
{
    /**
     * @param string $sourceName
     * @return mixed
     * @throws DataProviderException
     */
    public function getData(string $sourceName): array;

    public function getType(): string;
}