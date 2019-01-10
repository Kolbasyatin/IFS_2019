<?php


namespace App\Tests\Services;


use App\Lib\DataProviderTypes;
use App\Lib\Sources;
use App\Services\Informer;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class InformerMpdTest extends WebTestCase
{
    public function testGetInfo()
    {
        self::bootKernel();
        $informer = self::$container->get(Informer::class);
        $result = $informer->getInfo(Sources::MDS_VOICE, DataProviderTypes::MPD_TYPE);

    }
}