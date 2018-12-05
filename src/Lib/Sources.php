<?php


namespace App\Lib;


class Sources
{
    public const MDS_VOICE = 'voice';

    public const MDS_MUSIC = 'music';

    public static function getSourcesName(): array
    {
        return [
            self::MDS_VOICE,
            self::MDS_MUSIC,
        ];
    }
}