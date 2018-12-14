<?php


namespace App\Services\DataProviders\Factories\Config;


use App\Lib\Exceptions\FactoryDataProviderException;

/**
 * Class ProviderConfigFactory
 * @package App\Services\DataProviders\Factories\Config
 */
class ProviderConfigFactory
{

    /**
     * @var string
     */
    public const YAML_TYPE = 'yaml';

    /**
     * @var string
     */
    public const ENTITY_TYPE = 'entity';

    /** @var array */
    private $config;

    /** @var YamlProviderConfig */
    private $yamlConfig;

    /** @var EntityProviderConfig */
    private $entityConfig;

    /**
     * ProviderConfigFactory constructor.
     * @param array $config
     * @param EntityProviderConfig $entityConfig
     * @param YamlProviderConfig $yamlConfig
     */
    public function __construct(array $config, EntityProviderConfig $entityConfig, YamlProviderConfig $yamlConfig)
    {
        $this->config = $config;
        $this->entityConfig = $entityConfig;
        $this->yamlConfig = $yamlConfig;
    }

    /**
     * @return EntityProviderConfig|YamlProviderConfig
     * @throws FactoryDataProviderException
     */
    public function createConfig()
    {
        $type = $this->config['type'];
        switch ($type) {
            case self::YAML_TYPE:
                return $this->yamlConfig;
            case self::ENTITY_TYPE:
                return $this->entityConfig;
            default:
                throw new FactoryDataProviderException(sprintf('There is no corresponding config provider for %s type', $type));
        }
    }


}