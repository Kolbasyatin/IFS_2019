<?php


namespace App\Services\DataProviders;


use App\Lib\DataProviderTypes;

class MpdDataProvider implements DataProviderInterface
{
    public function getData()
    {
        return 'data!';
    }

    public function getType(): string
    {
        return DataProviderTypes::MPD_TYPE;
    }

}