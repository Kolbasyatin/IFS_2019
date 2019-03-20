<?php


namespace App\Tests\Services;


use App\Entity\Source;
use App\Services\Informer;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class InformerTest
 * @package App\Tests\Services
 */
class InformerTest extends WebTestCase
{

    /**
     * @var string
     */
    public const TEST_SOURCE_NAME = 'test_voice';


    public function testGetSources()
    {
        static::bootKernel();
        $actual = static::$container->get(Informer::class)->getSources();
        foreach ($actual as $source) {
            /** @var Source $source */
            $this->assertInstanceOf(Source::class, $source);
            $this->assertContains($source->getName(), ['test_voice']);
        }
    }
}