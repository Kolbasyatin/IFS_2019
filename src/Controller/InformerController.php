<?php


namespace App\Controller;


use App\Lib\Info\InfoQuery;
use App\Services\Informer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class InformerController
 * @package App\Controller
 * @Route("/")
 */
class InformerController extends AbstractController
{
    /**
     * @param Informer $informer
     * @Route("/")
     */
    public function index(Informer $informer)
    {
        $query = new InfoQuery();
        $query->setSource('voice');
        $data = $informer->getInfo($query);
        $b = 'c';
    }
}