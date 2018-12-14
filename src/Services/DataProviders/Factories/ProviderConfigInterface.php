<?php


namespace App\Services\DataProviders\Factories;


use App\Entity\Source;

interface ProviderConfigInterface
{
    public function getSource(): Source;

    public function getProviderType(): string;

    public function getUrl(): string;

    public function getLogin(): string;

    public function getPassword(): string;
}