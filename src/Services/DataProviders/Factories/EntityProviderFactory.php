<?php


namespace App\Services\DataProviders\Factories;


use App\Services\DataProviders\DataProviderInterface;

class EntityProviderFactory extends AbstractProviderFactory
{
    //** TODO: В данном случае нужно забирать из базы данных и заполнять конфиг генерируя FactoryDataProviderConв yaml */
    protected function createProviderConfigs(array $config): void
    {
        // TODO: Implement createProviderConfigs() method.
    }

}