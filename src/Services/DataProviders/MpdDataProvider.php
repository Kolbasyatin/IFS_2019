<?php


namespace App\Services\DataProviders;


use App\Lib\DataProviderTypes;
use App\Lib\Exceptions\DataClientException;
use App\Lib\Exceptions\DataProviderException;
use App\Lib\Exceptions\MpdClientException;
use App\Services\DataProviders\Clients\ClientMaps\ClientMapInterface;
use App\Services\DataProviders\Clients\ClientMaps\MpdClientMap;
use App\Services\DataProviders\Clients\MpdClient;
use App\Services\DataProviders\Clients\MpdParser;

/**
 * Class MpdDataProvider
 * @package App\Services\DataProviders
 */
class MpdDataProvider implements DataProviderInterface
{

    /** @var ClientMapInterface */
    private $clientMap;
    /**
     * @var MpdParser
     */
    private $mpdParser;

    /**
     * MpdDataProvider constructor.
     * @param MpdClientMap $clientMap
     * @param MpdParser $mpdParser
     */
    public function __construct(MpdClientMap $clientMap, MpdParser $mpdParser)
    {
        $this->clientMap = $clientMap;
        $this->mpdParser = $mpdParser;
    }


    /**
     * @param string $sourceName
     * @return array
     * @throws DataClientException
     * @throws DataProviderException
     */
    public function getData(string $sourceName): array
    {
        /** @var MpdClient $mpdClient */
        $mpdClient = $this->clientMap->getClient($sourceName);
        try {
            $statusRaw = $mpdClient->status();
            $status = $this->mpdParser->parse($statusRaw);
            $currentRaw = $mpdClient->currentsong();
            $currentSong = $this->mpdParser->parse($currentRaw);
            $nextSongId = $status['nextsongid'] ?? null;
            $nextSong = null;
            if (null !== $nextSongId ){
                $nextRaw = $mpdClient->playlistid();
                $nextSong = $this->mpdParser->parse($nextRaw);
            }

            $result = [
                'status' => $status,
                'currentSong' => $currentSong,
                'nextSong' => $nextSong
            ];
            /** Не подсвечивает throws когда __call */
        } catch (MpdClientException $exception) {
            throw new DataProviderException('Mpd client error. '.$exception->getMessage());
        }

        return $result;
    }


    /**
     * @return string
     */
    public function getType(): string
    {
        return DataProviderTypes::MPD_TYPE;
    }

}