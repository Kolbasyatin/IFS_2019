<?php


namespace App\Services;


use App\Lib\Exceptions\InformerException;
use App\Lib\Info\InfoAnswer;
use App\Lib\Info\InfoQuery;
use App\Services\DataProviders\Factories\AbstractProviderFactory;
use App\Services\DataProviders\Factories\ProviderFactoryInterface;
use App\Services\Fillers\FillerFactory;

class Informer
{

    /** @var FillerFactory */
    private $fillerFactory;

    /** @var AbstractProviderFactory  */
    private $providerFactory;


    /**
     * Informer constructor.
     * @param FillerFactory $fillerFactory
     * @param AbstractProviderFactory $factory
     */
    public function __construct(
        FillerFactory $fillerFactory,
        ProviderFactoryInterface $factory
    ) {

        $this->fillerFactory = $fillerFactory;
        $this->providerFactory = $factory;
    }


    public function getInfo(InfoQuery $infoQuery): InfoAnswer
    {
        $answer = new  InfoAnswer();
        try {
            $provider = $this->providerFactory->create($infoQuery->getSource());
            $data = $provider->getData();
            $filler = $this->fillerFactory->getFiller($provider->getType());
            $filler->fill($data, $answer);
        } catch (InformerException $e) {
            $answer->setStatus('error')->setErrorReason($e->getMessage());
        }

        return $answer;
    }
}