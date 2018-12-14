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
    /** @var array */
    private $config;

    /** @var Serializer */
    private $serializer;

    /**
     * YamlProviderConfig constructor.
     * @param array $config
     * @param SerializerInterface $serializer
     */
    public function __construct(array $config, SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
        $this->config = $config;
    }


    /**
     * @return array
     * @throws FactoryDataProviderException
     */
    public function getConfig(): array
    {
        return $this->createProviderConfigs();
    }


    /**
     * @return array
     * @throws FactoryDataProviderException
     */
    protected function createProviderConfigs(): array
    {
        $providerConfigs = [];
        $sources = $this->config['sources'] ?? null;
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