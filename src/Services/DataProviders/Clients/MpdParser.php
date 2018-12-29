<?php


namespace App\Services\DataProviders\Clients;


class MpdParser
{
    public function parse(array $data): array
    {
        $result = [];
        array_map(
            function ($field) use (&$result) {
                if ($field !== 'OK') {
                    [$key, $value] = preg_split('/:\ /', $field, 2);
                    $result[$key] = $value;
                }

            },
            $data
        );


        return $result;
    }
}