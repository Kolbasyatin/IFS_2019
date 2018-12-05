<?php


namespace App\Services\DataProviders;


use App\Lib\DataProviderTypes;
use App\Lib\Exceptions\DataProviderException;

class JsonDataProvider implements DataProviderInterface
{
    public function getData()
    {
        return 'json!';
    }

    public function getType(): string
    {
        return DataProviderTypes::JSON_TYPE;
    }

}