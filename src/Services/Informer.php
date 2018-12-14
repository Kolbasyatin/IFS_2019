<?php


namespace App\Services;


use App\Lib\Exceptions\InformerException;
use App\Lib\Info\InfoAnswer;
use App\Services\DataProviders\Factories\Config\FactoryConfigInterface;
use App\Services\DataProviders\Factories\DataProviderFactory;
use App\Services\DataProviders\Factories\ProviderConfigInterface;
use App\Services\Fillers\FillerManager;

class Informer
{

    /** @var FillerManager */
    private $fillerManager;

    /** @var DataProviderFactory  */
    private $providerFactory;
    /**
     * @var FactoryConfigInterface
     */
    private $factoryConfig;


    /**
     * Informer constructor.
     * @param FillerManager $fillerManager
     * @param DataProviderFactory $factory
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


    public function getInfo(string $sourceName, string $providerType = null): InfoAnswer
    {
        $answer = new  InfoAnswer();
        try {
            $provider = $this->providerFactory->create($sourceName, $providerType);
            $data = $provider->getData();
            $answer->setSource($sourceName);
            $this->fillerManager->fill($data, $provider->getType(), $answer);

        } catch (InformerException $e) {
            $answer->setSource($sourceName);
            $answer->setStatus(InfoAnswer::ERROR_STATUS)->setErrorReason($e->getMessage());
        }

        return $answer;
    }

    public function getSources()
    {
        $result = [];
        /** @var ProviderConfigInterface $config */
        foreach ($this->factoryConfig->getConfig() as $config) {
            $source = $config->getSource();
            if (! ($result[$source->getName()] ?? null)) {
                $result[$source->getName()][] = $source;
            }

        }

        $result = array_merge(...array_values($result));

        return $result;
    }

}