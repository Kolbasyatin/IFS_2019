<?php

namespace App\Controller\Api;

use App\Lib\Info\InfoQuery;
use App\Lib\Sources;
use App\Services\Informer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class InformerController
 * @package App\Controller\Api
 * @Route("/informer")
 */
class InformerController extends AbstractController
{

    /**
     * @Route("/sources")
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
     * @Route( "/voice/{type}", defaults={"type" : "json"})
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
     * @Route("/music/{type}", defaults={"type" : "json"})
     */
    public function music(Informer $informer, string $type): Response
    {
        $query = new InfoQuery();
        $query->setSource(Sources::MDS_MUSIC)->setProviderType($type);
        $info = $informer->getInfo($query);

        return $this->json($info, 200, [], ['json_encode_options' => JSON_UNESCAPED_UNICODE]);
    }
}
