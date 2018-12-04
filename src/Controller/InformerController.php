<?php


namespace App\Controller;


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
        $a = 'b';
    }
}