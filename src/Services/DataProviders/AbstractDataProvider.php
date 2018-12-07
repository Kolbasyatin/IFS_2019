<?php


namespace App\Services\DataProviders;


use App\Services\DataProviders\Factories\ProviderConfigInterface;

abstract class AbstractDataProvider implements DataProviderInterface
{

    /** @var ProviderConfigInterface */
    protected $config;


    /**
     * @param ProviderConfigInterface $config
     * @return $this|DataProviderInterface
     */
    public function setConfig(ProviderConfigInterface $config): DataProviderInterface
    {
        $this->config = $config;

        return $this;
    }

}