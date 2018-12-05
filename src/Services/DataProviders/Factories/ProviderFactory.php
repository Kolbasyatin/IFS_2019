<?php


namespace App\Services\DataProviders\Factories;


use App\Lib\Exceptions\InformerException;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ProviderFactory
{

    public const YAML_TYPE = 'yaml';

    public const ENTITY_TYPE = 'entity';


    /** @var array */
    private $config;
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * ProviderFactory constructor.
     * @param ContainerInterface $container
     * @param array $config
     */
    public function __construct(ContainerInterface $container, array $config)
    {
        $this->config = $config;
        $this->container = $container;
    }

    /**
     * @return ProviderFactoryInterface
     * @throws InformerException
     */
    public function create(): ProviderFactoryInterface
    {
        $type = $this->config['type'];
        switch ($type) {
            case self::YAML_TYPE:
                return $this->container->get(YamlProviderFactory::class);
            case self::ENTITY_TYPE:
                return $this->container->get(EntityProviderFactory::class);
            default:
                throw new InformerException(sprintf('There is no corresponding factory for %s type', $type ));
        }
    }


}