<?php

namespace App\Controller\Api;

use App\Services\Informer;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @return JsonResponse
     */
    public function sources(Informer $informer): JsonResponse
    {
        return $this->json($informer->getSources());
    }

    /**
     * @param Informer $informer
     * @param string $source
     * @return Response
     * @throws Exception
     * @Route( "/source/{source}")
     */
    public function sourceInfo(Informer $informer, string $source): Response
    {
        $info = $informer->getInfo($source);

        return $this->json($info, 200, [], ['json_encode_options' => JSON_UNESCAPED_UNICODE]);
    }

}
