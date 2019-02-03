<?php


namespace App\Services\Fillers;


use App\Lib\DataProviderTypes;
use App\Lib\Info\IceCastJsonModel;
use App\Lib\Info\SourceInfo;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class IceCastJsonFiller implements FillerInterface
{

    /** @var Serializer */
    private $serializer;

    /**
     * IceCastJsonFiller constructor.
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }


    public function fill(array $data, SourceInfo $answer): void
    {

        /** @var IceCastJsonModel $model */
        $model = $this->serializer->denormalize($data, IceCastJsonModel::class);
        $model->fillAnswer($answer);

    }

    public function isSupport(string $type): string
    {
        return $type === DataProviderTypes::JSON_TYPE;
    }

}