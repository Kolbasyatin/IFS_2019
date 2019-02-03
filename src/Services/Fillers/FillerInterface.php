<?php


namespace App\Services\Fillers;


use App\Lib\Exceptions\FillerException;
use App\Lib\Info\SourceInfo;

interface FillerInterface
{
    /**
     * @param $data
     * @param SourceInfo $answer
     * @throws FillerException
     */
    public function fill(array $data, SourceInfo $answer): void;

    public function isSupport(string $type): string;

}