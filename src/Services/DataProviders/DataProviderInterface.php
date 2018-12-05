<?php


namespace App\Services\DataProviders;


use App\Lib\Exceptions\DataProviderException;

interface DataProviderInterface
{
    /**
     * @return mixed
     * @throws DataProviderException
     */
    public function getData();

    public function getType(): string;
}