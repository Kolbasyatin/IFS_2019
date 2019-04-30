<?php

namespace App\Controller\Api;


use App\Lib\Info\SourceInfo;
use App\Services\DataProviders\Clients\ClientMaps\MpdClientMap;
use App\Services\DataProviders\Clients\MpdClient;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class InformerControllerTest
 * @package App\Controller\Api
 */
class InformerControllerTest extends WebTestCase
{

    /**
     *
     */
    public function testSources()
    {
        $client = self::createClient();
        $client->request(Request::METHOD_GET, '/api/informer/sources');
        $actual = $client->getResponse()->getContent();

        $expected = [
            [
                'name' => 'test_voice',
                'priority' => 10,
            ],
        ];

        $this->assertEquals(json_encode($expected), $actual);

    }

    /**
     * @throws \App\Lib\Exceptions\DataClientException
     */
    public function testSourceInfo()
    {
        self::bootKernel();
        $mpdClient = self::$container->get(MpdClientMap::class)->getClient('test_voice');
        $mpdClient->clear();
        $listAll = $mpdClient->listall();

        $files = array_map(
            static function ($file) {
                return str_replace('file: ', '', $file);
            },
            $listAll
        );

        /** @var MpdClient $mpdClient */
        foreach ($files as $file) {
            $mpdClient->add("\"$file\"");
        }

        $mpdClient->play();

        $client = self::createClient();
        $client->request(Request::METHOD_GET, '/api/informer/source/test_voice');
        $actual = json_decode($client->getResponse()->getContent(), true);
        $this->assertSame($actual['status'], SourceInfo::ONLINE_STATUS);

        $mpdClient->stop();
        $mpdClient->clear();

    }

    /**
     *
     */
    public function testSourceInfoNoPlaying()
    {
        $client = self::createClient();
        $client->request(Request::METHOD_GET, '/api/informer/source/test_voice');
        $actual = json_decode($client->getResponse()->getContent(), true);

        $this->assertSame($actual['status'], SourceInfo::ERROR_STATUS);

    }

    /**
     *
     */
    public function testFailSourceInfo()
    {
        $client = self::createClient();
        $client->request(Request::METHOD_GET, '/api/informer/source/fake_name');
        $actual = json_decode($client->getResponse()->getContent(), true);
        $this->assertSame($actual['status'], SourceInfo::ERROR_STATUS);
        $this->assertSame($actual['error_reasons'][0], 'No source exists');

    }

}
