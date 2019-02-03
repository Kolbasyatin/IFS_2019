<?php


namespace App\Services\Fillers;


use App\Lib\DataProviderTypes;
use App\Lib\Info\SourceInfo;

class MpdFiller implements FillerInterface
{
    public function fill(array $data, SourceInfo $answer): void
    {
        $status = $data['status'];
        $currentSong = $data['currentSong'];
        $nextSong = $data['nextSong'];

        $answer
            ->setSongName($currentSong['Title'] ?? $currentSong['file'] ?? '')
            ->setNextSongName($nextSong['Title'] ?? $nextSong['file'] ?? '')
            ->setLengthTime(new \DateInterval(sprintf('PT%sS', $currentSong['Time'])))
            ->setElapsedType(new \DateInterval(sprintf('PT%sS', (int)$status['elapsed'])))
        ;

    }

    public function isSupport(string $type): string
    {
        return $type === DataProviderTypes::MPD_TYPE;
    }

}