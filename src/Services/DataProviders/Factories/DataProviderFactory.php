<?php


namespace App\Services\DataProviders\Factories;


use App\Lib\DataProviderTypes;
use App\Lib\Exceptions\FactoryDataProviderException;
use App\Services\DataProviders\DataProviderInterface;
use App\Services\DataProviders\Factories\Config\FactoryConfigInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class DataProviderFactory
{
    private const DEFAULT_PROVIDER_TYPE = DataProviderTypes::JSON_TYPE;


    /** @var FactoryConfigInterface */
    protected $config;

    /** @var ContainerInterface */
    private $container;

    /**
     * AbstractProviderFactory constructor.
     * @param ContainerInterface $container
     * @param FactoryConfigInterface $config
     */
    public function __construct(ContainerInterface $container, FactoryConfigInterface $config)
    {
        $this->container = $container;
        $this->config = $config;
    }

    /**
     * @param string $sourceName
     * @param string|null $type
     * @return DataProviderInterface|object
     * @throws FactoryDataProviderException
     */
    public function create(string $sourceName, ?string $type = null): DataProviderInterface
    {
        if (null === $type) {
            $type = static::DEFAULT_PROVIDER_TYPE;
        }
        $providerConfig = $this->config->getConfig();
        if (!$providerConfig) {
            throw new FactoryDataProviderException('No config!');
        }
        foreach ($providerConfig as $config) {
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

//    public function getSources(): array
//    {
//        $result = [];
//        foreach ($this->providerConfigs as $config) {
//            $result[] = $config->getSource();
//        }
//
//        return array_values(array_unique($result));
//    }

}