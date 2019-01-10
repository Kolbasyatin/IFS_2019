<?php


namespace App\Services\Fillers;


use App\Lib\DataProviderTypes;
use App\Lib\Info\InfoAnswer;

class MpdFiller implements FillerInterface
{
    public function fill(array $data, InfoAnswer $answer): void
    {
        $a = 'b';

    }

    public function isSupport(string $type): string
    {
        return $type === DataProviderTypes::MPD_TYPE;
    }

}