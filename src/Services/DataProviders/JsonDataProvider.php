<?php


namespace App\Services\DataProviders;


use App\Lib\DataProviderTypes;

class JsonDataProvider extends AbstractDataProvider
{

    private $client;

    public function getData()
    {
        return 'json!';
    }

    public function getType(): string
    {
        return DataProviderTypes::JSON_TYPE;
    }

}