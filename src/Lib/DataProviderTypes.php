<?php


namespace App\Lib;


class DataProviderTypes
{
    public const MPD_TYPE = 'mpd';

    public const JSON_TYPE = 'json';

    public const DEFAULT_PROVIDER_TYPE = self::JSON_TYPE;


    /**
     * @return array
     */
    public static function getTypes(): array
    {
        return [
            self::JSON_TYPE,
            self::MPD_TYPE
        ];
    }
}