<?php


namespace App\Services\DataProviders;


use App\Lib\Exceptions\DataProviderException;
use App\Lib\Info\DataProviderQueryInterface;

interface DataProviderInterface
{
    /**
     * @param DataProviderQueryInterface $dataQuery
     * @return mixed
     * @throws DataProviderException
     */
    public function getData(DataProviderQueryInterface $dataQuery);

    public function getType(): string;
}