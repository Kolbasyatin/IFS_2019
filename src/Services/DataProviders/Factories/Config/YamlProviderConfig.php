<?php


namespace App\Services\DataProviders\Factories\Config;


use App\Entity\Source;
use App\Lib\Exceptions\FactoryDataProviderException;
use App\Services\DataProviders\Factories\ProviderConfig;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class YamlProviderConfig
 * @package App\Services\DataProviders\Factories\Config
 */
class YamlProviderConfig implements FactoryConfigInterface
{
    /** @var ProviderConfig[] */
    private $config;

    /** @var Serializer */
    private $serializer;

    /**
     * YamlProviderConfig constructor.
     * @param array $yamlConfig
     * @param SerializerInterface $serializer
     * @throws FactoryDataProviderException
     */
    public function __construct(array $yamlConfig, SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
        $this->config = $this->createProviderConfigs($yamlConfig);
    }


    /**
     * @return array
     * @throws FactoryDataProviderException
     */
    public function getConfig(): array
    {
        if (!$this->config) {
            throw new FactoryDataProviderException('No config!');
        }

        return $this->config;
    }


    /**
     * @param array $yamlConfig
     * @return ProviderConfig[]
     * @throws FactoryDataProviderException
     */
    protected function createProviderConfigs(array $yamlConfig): array
    {
        $providerConfigs = [];
        $sources = $yamlConfig['sources'] ?? null;
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