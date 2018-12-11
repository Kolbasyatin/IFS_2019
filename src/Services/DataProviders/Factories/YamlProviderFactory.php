<?php


namespace App\Services\DataProviders\Factories;


use App\Lib\Exceptions\FactoryDataProviderException;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class YamlProviderFactory extends AbstractProviderFactory
{

    /** @var Serializer */
    protected $serializer;

    public function __construct(array $config, ContainerInterface $container, SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
        parent::__construct($config, $container);
    }


    /**
     * @param array $config
     * @return void
     * @throws FactoryDataProviderException
     */
    protected function createProviderConfigs(array $config): void
    {
        $sources = $config['sources'] ?? null;
        if (null === $sources) {
            throw new FactoryDataProviderException('Wrong yaml config in sources description file!');
        }
        try {
            foreach ($sources as $source) {
                foreach ($source['informers'] as $informerConfig) {
                    $providerConfig = new ProviderConfig();
                    $providerConfig->setSource($source['name']);
                    $this->serializer->denormalize(
                        $informerConfig,
                        ProviderConfig::class,
                    null,
                        [
                            'object_to_populate' => $providerConfig
                        ]
                    );
                    $this->providerConfigs[] = $providerConfig;
                }

            }
        } catch (\Exception $e) {
            throw new FactoryDataProviderException('Wrong yaml config in sources description file!');
        }


    }


}