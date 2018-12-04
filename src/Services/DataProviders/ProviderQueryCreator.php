<?php


namespace App\Services\DataProviders;


use App\Lib\Info\ProviderQuery;
use App\Lib\Info\ProviderTypeInterface;
use App\Lib\Info\InfoQuery;

class ProviderQueryCreator
{
    public function create(InfoQuery $query): ProviderTypeInterface
    {
        $source = $query->getSource();
        /** TODO: get from entity */
        $type = new ProviderQuery();
        $type->setType('test');

        return $type;
    }
}