<?php


namespace App\Services\DataProviders\Factories;


use App\Lib\DataProviderTypes;
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
        $this->providerConfigs = $this->createProviderConfigs($config);
        $this->container = $container;
    }

    abstract protected function createProviderConfigs(array $config): array;

    /**
     * @param string $sourceName
     * @param string|null $type
     * @return DataProviderInterface|object
     * @throws FactoryDataProviderException
     */
    public function create(string $sourceName, string $type = DataProviderTypes::JSON_TYPE): DataProviderInterface
    {
        foreach ($this->providerConfigs as $config) {
            if (!$config instanceof ProviderConfigInterface) {
                throw new FactoryDataProviderException('Wrong config interface.');
            }
            $source = $config->getSource();
            if ($source->getName() === $sourceName && $type === $config->getProviderType()) {
                $serviceName = sprintf('App\Services\DataProviders\\%sDataProvider', ucfirst($type));
                if ($this->container->has($serviceName)) {
                    return $this->container->get($serviceName)->setConfig($config);
                }
            }
        }

        throw new FactoryDataProviderException('Can not create Data Provider '.$type);
    }

    public function getSources(): array
    {
        $result = [];
        foreach ($this->providerConfigs as $config) {
            $result[] = $config->getSource();
        }

        return array_values(array_unique($result));
    }

}