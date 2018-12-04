<?php


namespace App\Services\Fillers;


use App\Lib\Info\InfoAnswer;

interface FillerInterface
{
    public function fill($data, InfoAnswer $answer): void;

}