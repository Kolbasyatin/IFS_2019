<?php


namespace App\Services\DataProviders;


use App\Lib\Info\DataProviderQueryInterface;
use App\Lib\Info\ProviderTypeInterface;
use App\Lib\Info\InfoQuery;

class DataQueryFactory
{
    public function createProviderType(InfoQuery $infoQuery): ProviderTypeInterface
    {

    }

    public function createProviderQuery(InfoQuery $infoQuery): DataProviderQueryInterface
    {

    }
}