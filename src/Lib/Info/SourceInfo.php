<?php


namespace App\Lib\Info;


use DateInterval;
use DateTime;

/**
 * Class InfoAnswer
 * @package App\Lib\Info
 */
class SourceInfo
{

    /** @var string  */
    public const ONLINE_STATUS = 'online';

    /** @var string  */
    public const ERROR_STATUS = 'error';

    /** @var string */
    private $source;

    /** @var string */
    private $status;

    /** @var int|null */
    private $listeners;

    /** @var string|null */
    private $songName;

    /** @var string|null */
    private $previousSong;

    /** @var string|null */
    private $nextSongName;

    /** @var DateTime */
    private $currentTime;

    /** @var DateInterval|null */
    private $elapsedType;

    /** @var DateInterval|null */
    private $lengthTime;

    /** @var string[]|null */
    private $errorReasons;

    /**
     * InfoAnswer constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->currentTime = new DateTime('now');
    }

    public function getCurrentTime()
    {
        return $this->currentTime;
    }

    /**
     * @return string
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * @param string $source
     * @return SourceInfo
     */
    public function setSource(string $source): SourceInfo
    {
        $this->source = $source;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return SourceInfo
     */
    public function setStatus(string $status): SourceInfo
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getListeners(): ?int
    {
        return $this->listeners;
    }

    /**
     * @param int|null $listeners
     * @return SourceInfo
     */
    public function setListeners(?int $listeners): SourceInfo
    {
        $this->listeners = $listeners;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSongName(): ?string
    {
        return $this->songName;
    }

    /**
     * @param string|null $songName
     * @return SourceInfo
     */
    public function setSongName(?string $songName): SourceInfo
    {
        $this->songName = $songName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPreviousSong(): ?string
    {
        return $this->previousSong;
    }

    /**
     * @param string|null $previousSong
     * @return SourceInfo
     */
    public function setPreviousSong(?string $previousSong): SourceInfo
    {
        $this->previousSong = $previousSong;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getNextSongName(): ?string
    {
        return $this->nextSongName;
    }

    /**
     * @param string|null $nextSongName
     * @return SourceInfo
     */
    public function setNextSongName(?string $nextSongName): SourceInfo
    {
        $this->nextSongName = $nextSongName;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getStartTime(): ?DateTime
    {
        if (!$this->getElapsedType()) {
            return null;
        }

        return (clone $this->currentTime)->modify(sprintf('- %s seconds', $this->elapsedType->format('%s')));
    }


    /**
     * @return DateTime|null
     */
    public function getEndTime(): ?DateTime
    {
        if (!$this->getLengthTime()) {
            return null;
        }

        return (clone $this->currentTime)->modify(sprintf('+ %s seconds', $this->lengthTime->format('%s')));
    }


    /**
     * @return DateInterval|null
     */
    public function getElapsedType(): ?DateInterval
    {
        return $this->elapsedType;
    }

    /**
     * @param DateInterval|null $elapsedType
     * @return SourceInfo
     */
    public function setElapsedType(?DateInterval $elapsedType): SourceInfo
    {
        $this->elapsedType = $elapsedType;

        return $this;
    }

    /**
     * @return DateInterval|null
     */
    public function getLengthTime(): ?DateInterval
    {
        return $this->lengthTime;
    }

    /**
     * @param DateInterval|null $lengthTime
     * @return SourceInfo
     */
    public function setLengthTime(?DateInterval $lengthTime): SourceInfo
    {
        $this->lengthTime = $lengthTime;

        return $this;
    }

    /**
     * @return string[]|null
     */
    public function getErrorReasons(): array
    {
        return $this->errorReasons;
    }

    /**
     * @param array $errorReasons
     * @return SourceInfo
     */
    public function setErrorReasons(array $errorReasons): SourceInfo
    {
        $this->errorReasons = $errorReasons;

        return $this;
    }

    public function addErrorReason(string $errorReason): SourceInfo
    {
        $this->errorReasons[] = $errorReason;

        return $this;
    }


}