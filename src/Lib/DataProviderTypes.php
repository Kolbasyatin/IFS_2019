<?php


namespace App\Lib;


class DataProviderTypes
{
    public const MPD_TYPE = 'mpd';

    public const JSON_TYPE = 'json';

    /**
     * @return array
     */
    public static function getTypes(): array
    {
        return [
            self::MPD_TYPE,
        ];
    }
}