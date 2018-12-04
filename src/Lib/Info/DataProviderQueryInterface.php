<?php


namespace App\Lib\Info;


interface DataProviderQueryInterface
{
    public function getAddress(): string;

    public function getUser(): string;

    public function getPassword(): string;
}