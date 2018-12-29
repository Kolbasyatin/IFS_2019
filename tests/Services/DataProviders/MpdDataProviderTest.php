<?php


namespace App\Tests\Services\DataProviders;


use App\Lib\Sources;
use App\Services\DataProviders\Clients\ClientMaps\MpdClientMap;
use App\Services\DataProviders\Clients\MpdClient;
use App\Services\DataProviders\MpdDataProvider;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MpdDataProviderTest extends WebTestCase
{
    /**
     * @dataProvider mpdDataProvider
     */
    public function testGetData($status, $current, $next)
    {
        self::bootKernel();
        $client = $this->createMock(MpdClient::class);
        $client->expects($this->exactly(3))->method('__call')->willReturn($status, $current, $next);

        $clientMap = $this->createMock(MpdClientMap::class);
        $clientMap->expects($this->once())->method('getClient')->willReturn($client);
        self::$container->set('test.mpd_client_map', $clientMap);
        $service = self::$container->get(MpdDataProvider::class);
        $data = $service->getData(Sources::MDS_MUSIC);
        foreach (['status', 'currentSong', 'nextSong'] as $key) {
            $this->assertArrayHasKey($key, $data);
        }
        $this->assertCount(17, $data['status']);
        $this->assertCount(12, $data['currentSong']);
        $this->assertCount(11, $data['nextSong']);

    }

    public function mpdDataProvider()
    {

        $status = [
            0 => 'volume: -1',
            1 => 'repeat: 1',
            2 => 'random: 1',
            3 => 'single: 0',
            4 => 'consume: 0',
            5 => 'playlist: 2',
            6 => 'playlistlength: 4236',
            7 => 'mixrampdb: 0.000000',
            8 => 'state: play',
            9 => 'song: 1240',
            10 => 'songid: 1241',
            11 => 'time: 5:321',
            12 => 'elapsed: 4.527',
            13 => 'bitrate: 192',
            14 => 'audio: 44100:24:2',
            15 => 'nextsong: 1582',
            16 => 'nextsongid: 1583',
            17 => 'OK',
        ];

        $currentSong = [
            0 => 'file: Mitnik/Kruder and Dorfmeister – Gotta Jazz.mp3',
            1 => 'Last-Modified: 2015-10-10T17:32:46Z',
            2 => 'Artist: Kruder and Dorfmeister',
            3 => 'AlbumArtist: Kruder and Dorfmeister',
            4 => 'Title: gotta jazz',
            5 => 'Album: Count Basic Remixes',
            6 => 'Track: 2',
            7 => 'Date: 1999',
            8 => 'Genre: Electronic',
            9 => 'Time: 321',
            10 => 'Pos: 1240',
            11 => 'Id: 1241',
            12 => 'OK',
        ];

        $nextSong = [
            0 => 'file: Mitnik/Zen Garden – Sundance.mp3',
            1 => 'Last-Modified: 2015-10-10T17:33:16Z',
            2 => 'Artist: Zen Garden',
            3 => 'Title: Sundance',
            4 => 'Album: Simple Thought',
            5 => 'Track: 6/12',
            6 => 'Date: 2010',
            7 => 'Genre: Ambient',
            8 => 'Time: 480',
            9 => 'Pos: 1582',
            10 => 'Id: 1583',
            11 => 'OK',
        ];

        return [
            [
                $status,
                $currentSong,
                $nextSong,
            ],
        ];
    }

}