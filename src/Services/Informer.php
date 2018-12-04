<?php


namespace App\Services;


use App\Lib\Exceptions\InformerException;
use App\Lib\Info\InfoAnswer;
use App\Lib\Info\InfoQuery;
use App\Services\DataProviders\DataProviderFactory;
use App\Services\DataProviders\DataQueryFactory;
use App\Services\Fillers\FillerFactory;

class Informer
{
    /** @var DataQueryFactory */
    private $dataQueryFactory;

    /** @var DataProviderFactory */
    private $dataProviderFactory;

    /** @var FillerFactory */
    private $fillerFactory;


    /**
     * Informer constructor.
     * @param DataQueryFactory $dataQueryFactory
     * @param DataProviderFactory $dataProviderFactory
     * @param FillerFactory $fillerFactory
     */
    public function __construct(
        DataQueryFactory $dataQueryFactory,
        DataProviderFactory $dataProviderFactory,
        FillerFactory $fillerFactory
    ) {
        $this->dataQueryFactory = $dataQueryFactory;
        $this->dataProviderFactory = $dataProviderFactory;
        $this->fillerFactory = $fillerFactory;
    }


    public function getInfo(InfoQuery $infoQuery): InfoAnswer
    {
        $answer = new  InfoAnswer();
        try {
            $providerTypeQuery = $this->dataQueryFactory->createProviderType($infoQuery);
            $provider = $this->dataProviderFactory->create($providerTypeQuery);
            $providerDataQuery = $this->dataQueryFactory->createProviderQuery($infoQuery);
            $data = $provider->getData($providerDataQuery);
            $filler = $this->fillerFactory->getFiller($provider->getType());
            $filler->fill($data, $answer);
        } catch (InformerException $e) {
            $answer->setStatus('error')->setErrorReason($e->getMessage());
        }

        return $answer;
    }
}