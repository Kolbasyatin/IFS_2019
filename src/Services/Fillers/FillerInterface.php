<?php


namespace App\Services\Fillers;


use App\Lib\Exceptions\FillerException;
use App\Lib\Info\InfoAnswer;

interface FillerInterface
{
    /**
     * @param $data
     * @param InfoAnswer $answer
     * @throws FillerException
     */
    public function fill($data, InfoAnswer $answer): void;

    public function isSupport(string $type): string;

}