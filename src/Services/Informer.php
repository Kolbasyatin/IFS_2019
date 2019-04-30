<?php


namespace App\Services;


use App\Entity\Source;
use App\Lib\DataProviderTypes;
use App\Lib\Exceptions\InformerException;
use App\Lib\Info\SourceInfo;
use App\Services\DataProviders\Factories\Config\FactoryConfigInterface;
use App\Services\DataProviders\Factories\DataProviderFactory;
use App\Services\DataProviders\Factories\ProviderConfigInterface;
use App\Services\Fillers\FillerManager;
use Exception;

/**
 * Class Informer
 * @package App\Services
 */
class Informer
{

    /** @var FillerManager */
    private $fillerManager;

    /** @var DataProviderFactory */
    private $providerFactory;
    /**
     * @var FactoryConfigInterface
     */
    private $factoryConfig;


    /**
     * Informer constructor.
     * @param FillerManager $fillerManager
     * @param DataProviderFactory $factory
     * @param FactoryConfigInterface $factoryConfig
     */
    public function __construct(
        FillerManager $fillerManager,
        DataProviderFactory $factory,
        FactoryConfigInterface $factoryConfig
    ) {

        $this->fillerManager = $fillerManager;
        $this->providerFactory = $factory;
        $this->factoryConfig = $factoryConfig;
    }


    /**
     * @param string $sourceName
     * @param string|null $providerType with provider type handle source (or both when null)
     * @return SourceInfo
     * @throws Exception
     */
    public function getInfo(string $sourceName, string $providerType = null): SourceInfo
    {

        $answer = new  SourceInfo();
        $answer->setSource($sourceName);

        if (!$this->isSourceExists($sourceName)) {
            $answer->setStatus(SourceInfo::ERROR_STATUS)->addErrorReason('No source exists');

            return $answer;
        }

        if (null === $providerType) {
            $providerTypes = DataProviderTypes::getTypes();
        } else {
            $providerTypes = (array)$providerType;
        }

        $errors = [];
        foreach ($providerTypes as $type) {
            $provider = $this->providerFactory->create($type);
            try {
                $data = $provider->getData($sourceName);
                $this->fillerManager->fill($data, $provider->getType(), $answer);
            } catch (InformerException $e) {
                $errors[] = sprintf('%s: %s', $provider->getType(), $e->getMessage());
            }
        }

        if (count($errors) >= count($providerTypes)) {
            $answer->setStatus(SourceInfo::ERROR_STATUS);
        }

        $answer->setErrorReasons($errors);

        return $answer;
    }

    /**
     * @return array
     */
    public function getSources(): array
    {
        $result = [];
        /** @var ProviderConfigInterface $config */
        foreach ($this->factoryConfig->getConfig() as $config) {
            $source = $config->getSource();
            if (!($result[$source->getName()] ?? null)) {
                $result[$source->getName()][] = $source;
            }

        }

        $result = array_merge(...array_values($result));

        return $result;
    }

    private function isSourceExists(string $sourceName): bool
    {
        $sources = $this->getSources();

        return count(
            array_filter(
                $sources,
                static function ($source) use ($sourceName) {
                    /** @var  Source $source */
                    return $source->getName() === $sourceName;
                }
            )
        ) === 1;
    }


}