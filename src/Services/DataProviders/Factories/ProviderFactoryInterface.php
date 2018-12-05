<?php


namespace App\Services\DataProviders\Factories;


use App\Services\DataProviders\DataProviderInterface;

interface ProviderFactoryInterface
{
    public function create(string $sourceName): DataProviderInterface;
}