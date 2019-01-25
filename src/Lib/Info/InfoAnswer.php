<?php


namespace App\Lib\Info;


/**
 * Class InfoAnswer
 * @package App\Lib\Info
 */
class InfoAnswer
{

    /**
     *
     */
    public const ONLINE_STATUS = 'online';

    /**
     *
     */
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

    /** @var \DateTime|null */
    private $startTime;

    /** @var \DateTime|null */
    private $endTime;

    /** @var \DateTime */
    private $currentTime;

    /** @var \DateInterval|null */
    private $elapsedType;

    /** @var \DateInterval|null */
    private $lengthTime;

    /** @var string|null */
    private $errorReason;

    /**
     * InfoAnswer constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->currentTime = new \DateTime('now');
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
     * @return InfoAnswer
     */
    public function setSource(string $source): InfoAnswer
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
     * @return InfoAnswer
     */
    public function setStatus(string $status): InfoAnswer
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
     * @return InfoAnswer
     */
    public function setListeners(?int $listeners): InfoAnswer
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
     * @return InfoAnswer
     */
    public function setSongName(?string $songName): InfoAnswer
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
     * @return InfoAnswer
     */
    public function setPreviousSong(?string $previousSong): InfoAnswer
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
     * @return InfoAnswer
     */
    public function setNextSongName(?string $nextSongName): InfoAnswer
    {
        $this->nextSongName = $nextSongName;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getStartTime(): ?\DateTime
    {
        return (clone $this->currentTime)->modify(sprintf('- %s seconds', $this->elapsedType->format('%s')));
    }


    /**
     * @return \DateTime|null
     */
    public function getEndTime(): ?\DateTime
    {
        return (clone $this->currentTime)->modify(sprintf('+ %s seconds', $this->lengthTime->format('%s')));
    }


    /**
     * @return \DateInterval|null
     */
    public function getElapsedType(): ?\DateInterval
    {
        return $this->elapsedType;
    }

    /**
     * @param \DateInterval|null $elapsedType
     * @return InfoAnswer
     */
    public function setElapsedType(?\DateInterval $elapsedType): InfoAnswer
    {
        $this->elapsedType = $elapsedType;

        return $this;
    }

    /**
     * @return \DateInterval|null
     */
    public function getLengthTime(): ?\DateInterval
    {
        return $this->lengthTime;
    }

    /**
     * @param \DateInterval|null $lengthTime
     * @return InfoAnswer
     */
    public function setLengthTime(?\DateInterval $lengthTime): InfoAnswer
    {
        $this->lengthTime = $lengthTime;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getErrorReason(): ?string
    {
        return $this->errorReason;
    }

    /**
     * @param string|null $errorReason
     * @return InfoAnswer
     */
    public function setErrorReason(?string $errorReason): InfoAnswer
    {
        $this->errorReason = $errorReason;

        return $this;
    }


}