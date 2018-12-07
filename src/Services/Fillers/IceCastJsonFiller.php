<?php


namespace App\Services\Fillers;


use App\Lib\DataProviderTypes;
use App\Lib\Info\IceCastJsonModel;
use App\Lib\Info\InfoAnswer;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class IceCastJsonFiller implements FillerInterface
{
    public function fill($data, InfoAnswer $answer): void
    {
//        $encoders = [];
//        $normalizer = [new ObjectNormalizer()];
//        $serializer = new Serializer($normalizer, $encoders);
//
//        $serializer->denormalize($data, IceCastJsonModel::class, []);
//        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader() ))


//        $normalizer = new ObjectNormalizer(null, null, null, new ReflectionExtractor());
//        $normalizer->setSerializer(new Serializer([new DateTimeNormalizer(), new ObjectNormalizer(null, null, null, new ReflectionExtractor())]));
        $encoders = [new  JsonEncoder()];
        $normalizer = [new DateTimeNormalizer(), new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter(), null, new ReflectionExtractor())];
        $serializer = new Serializer($normalizer, $encoders);

        $data = json_encode($data);

        $aa = $serializer->deserialize($data, IceCastJsonModel::class, 'json');
        $adapter = $normalizer->denormalize($data, IceCastJsonModel::class);


        $a = 'b';

    }

    public function isSupport(string $type): string
    {
        return $type === DataProviderTypes::JSON_TYPE;
    }

}