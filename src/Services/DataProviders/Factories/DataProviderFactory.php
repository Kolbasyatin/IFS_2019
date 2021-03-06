<?php


namespace App\Services\DataProviders\Factories;


use App\Lib\DataProviderTypes;
use App\Lib\Exceptions\FactoryDataProviderException;
use App\Services\DataProviders\DataProviderInterface;
use App\Services\DataProviders\Factories\Config\FactoryConfigInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class DataProviderFactory
{
    /** @var ContainerInterface */
    private $container;

    /**
     * AbstractProviderFactory constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param string|null $type
     * @return DataProviderInterface|object
     * @throws FactoryDataProviderException
     */
    public function create(string $type): DataProviderInterface
    {

        $serviceName = sprintf('App\Services\DataProviders\\%sDataProvider', ucfirst($type));
        if ($this->container->has($serviceName)) {
            return $this->container->get($serviceName);
        }

        throw new FactoryDataProviderException('Can not create Data Provider '.$type);
    }

}