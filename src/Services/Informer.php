<?php


namespace App\Services;


use App\Lib\Exceptions\InformerException;
use App\Lib\Info\InfoAnswer;
use App\Lib\Info\InfoQuery;
use App\Services\DataProviders\Factories\AbstractProviderFactory;
use App\Services\DataProviders\Factories\ProviderFactoryInterface;
use App\Services\Fillers\FillerManager;

class Informer
{

    /** @var FillerManager */
    private $fillerManager;

    /** @var AbstractProviderFactory  */
    private $providerFactory;


    /**
     * Informer constructor.
     * @param FillerManager $fillerManager
     * @param ProviderFactoryInterface $factory
     */
    public function __construct(
        FillerManager $fillerManager,
        ProviderFactoryInterface $factory
    ) {

        $this->fillerManager = $fillerManager;
        $this->providerFactory = $factory;
    }


    public function getInfo(InfoQuery $infoQuery): InfoAnswer
    {
        $answer = new  InfoAnswer();
        try {
            $provider = $this->providerFactory->create($infoQuery->getSource());
            $data = $provider->getData();
            $answer->setSource($infoQuery->getSource());
            $this->fillerManager->fill($data, $provider->getType(), $answer);

        } catch (InformerException $e) {
            $answer->setSource($infoQuery->getSource());
            $answer->setStatus(InfoAnswer::ERROR_STATUS)->setErrorReason($e->getMessage());
        }

        return $answer;
    }


}