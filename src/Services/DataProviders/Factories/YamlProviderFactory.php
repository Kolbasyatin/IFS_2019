<?php


namespace App\Services\DataProviders\Factories;


use App\Entity\Source;
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
     * @return array
     * @throws FactoryDataProviderException
     */
    protected function createProviderConfigs(array $config): array
    {
        $providerConfigs = [];
        $sources = $config['sources'] ?? null;
        if (null === $sources || !is_iterable($sources)) {
            throw new FactoryDataProviderException('Wrong yaml config in sources description file!');
        }
        try {
            foreach ($sources as $source) {
                $sourceInstance = new Source();
                $sourceInstance
                    ->setName($source['name'])
                    ->setPriority($source['priority'] ?? null);
                foreach ($source['informers'] as $informerConfig) {
                    $providerConfig = new ProviderConfig();
                    $providerConfig->setSource($sourceInstance);
                    $this->serializer->denormalize(
                        $informerConfig,
                        ProviderConfig::class,
                        null,
                        [
                            'object_to_populate' => $providerConfig,
                        ]
                    );
                    $providerConfigs[] = $providerConfig;
                }

            }

            return $providerConfigs;

        } catch (\Exception $e) {
            throw new FactoryDataProviderException('Wrong yaml config in sources description file!');
        }


    }


}