<?php


namespace App\Services\DataProviders\Factories;



use App\Lib\Exceptions\FactoryDataProviderException;
use App\Services\DataProviders\DataProviderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class AbstractProviderFactory implements ProviderFactoryInterface
{

    /** @var array */
    protected $config;

    /** @var ProviderConfigInterface[] */
    protected $providerConfigs = [];

    /** @var ContainerInterface */
    private $container;

    /**
     * AbstractProviderFactory constructor.
     * @param array $config
     * @param ContainerInterface $container
     */
    public function __construct(array $config, ContainerInterface $container)
    {
        $this->createProviderConfigs($config);
        $this->container = $container;
    }

    abstract protected function createProviderConfigs(array $config): void;

    /**
     * @param string $sourceName
     * @return DataProviderInterface|object
     * @throws FactoryDataProviderException
     */
    public function create(string $sourceName): DataProviderInterface
    {
        foreach ($this->providerConfigs as $config) {
            if (!$config instanceof ProviderConfigInterface) {
                throw new FactoryDataProviderException('Wrong config interface.');
            }
            if ($config->getSource() === $sourceName) {
                $type = $config->getProviderType();
                $serviceName = sprintf('App\Services\DataProviders\\%sDataProvider', ucfirst($type));
                if($this->container->has($serviceName)){
                    return $this->container->get($serviceName)->setConfig($config);
                }
            }
        }

        throw new FactoryDataProviderException('Can not create Data Provider '.$serviceName);
    }

}