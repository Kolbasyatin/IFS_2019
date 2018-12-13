<?php


namespace App\Services\DataProviders\Factories;


interface ProviderConfigInterface
{
    public function getSource(): string;

    public function getProviderType(): string;

    public function getUrl(): string;

    public function getLogin(): string;

    public function getPassword(): string;
}