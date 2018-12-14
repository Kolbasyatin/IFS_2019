<?php

namespace App\Controller\Api;

use App\Lib\Info\InfoQuery;
use App\Lib\Sources;
use App\Services\DataProviders\Factories\ProviderFactoryInterface;
use App\Services\Informer;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class InformerController
 * @package App\Controller\Api
 * @Rest\Route("/informer")
 */
class InformerController extends AbstractController
{

    /**
     * @Rest\Route("/sources")
     * @param Informer $informer
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function sources(Informer $informer)
    {
        return $this->json($informer->getSources());
    }

    /**
     * @param Informer $informer
     * @param string $type
     * @return Response
     * @Rest\Route( "/voice/{type}", defaults={"type" : "json"})
     */
    public function voice(Informer $informer, string $type): Response
    {
        $query = new InfoQuery();
        $query->setSource(Sources::MDS_VOICE)->setProviderType($type);
        $info = $informer->getInfo((new InfoQuery())->setSource('voice'));

        return $this->json($info, 200, [], ['json_encode_options' => JSON_UNESCAPED_UNICODE]);
    }

    /**
     * @param Informer $informer
     * @return Response
     * @Rest\Route("/music/{type}", defaults={"type" : "json"})
     */
    public function music(Informer $informer, string $type): Response
    {
        $query = new InfoQuery();
        $query->setSource(Sources::MDS_MUSIC)->setProviderType($type);
        $info = $informer->getInfo($query);

        return $this->json($info, 200, [], ['json_encode_options' => JSON_UNESCAPED_UNICODE]);
    }
}
