<?php


namespace App\Services\DataProviders;


use App\Lib\DataProviderTypes;

class MpdDataProvider extends AbstractDataProvider
{



    public function getData(): array
    {
        return [];
    }

    public function getType(): string
    {
        return DataProviderTypes::MPD_TYPE;
    }

}