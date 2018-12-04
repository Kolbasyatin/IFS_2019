<?php


namespace App\Lib\Info;


class InfoAnswer
{
    /** @var string */
    private $source;

    /** @var string */
    private $status;

    /** @var int */
    private $listeners;

    /** @var int */
    private $songName;

    /** @var string */
    private $previousSong;

    /** @var string */
    private $nextSong;

    /** @var \DateTime */
    private $startTime;

    /** @var \DateTime */
    private $endTime;

    /** @var \DateTime */
    private $currentTime;

    /** @var \DateInterval */
    private $lengthTime;

    /** @var string */
    private $errorReason;

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
     * @return int
     */
    public function getListeners(): int
    {
        return $this->listeners;
    }

    /**
     * @param int $listeners
     * @return InfoAnswer
     */
    public function setListeners(int $listeners): InfoAnswer
    {
        $this->listeners = $listeners;

        return $this;
    }

    /**
     * @return int
     */
    public function getSongName(): int
    {
        return $this->songName;
    }

    /**
     * @param int $songName
     * @return InfoAnswer
     */
    public function setSongName(int $songName): InfoAnswer
    {
        $this->songName = $songName;

        return $this;
    }

    /**
     * @return string
     */
    public function getPreviousSong(): string
    {
        return $this->previousSong;
    }

    /**
     * @param string $previousSong
     * @return InfoAnswer
     */
    public function setPreviousSong(string $previousSong): InfoAnswer
    {
        $this->previousSong = $previousSong;

        return $this;
    }

    /**
     * @return string
     */
    public function getNextSong(): string
    {
        return $this->nextSong;
    }

    /**
     * @param string $nextSong
     * @return InfoAnswer
     */
    public function setNextSong(string $nextSong): InfoAnswer
    {
        $this->nextSong = $nextSong;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getStartTime(): \DateTime
    {
        return $this->startTime;
    }

    /**
     * @param \DateTime $startTime
     * @return InfoAnswer
     */
    public function setStartTime(\DateTime $startTime): InfoAnswer
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEndTime(): \DateTime
    {
        return $this->endTime;
    }

    /**
     * @param \DateTime $endTime
     * @return InfoAnswer
     */
    public function setEndTime(\DateTime $endTime): InfoAnswer
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCurrentTime(): \DateTime
    {
        return $this->currentTime;
    }

    /**
     * @param \DateTime $currentTime
     * @return InfoAnswer
     */
    public function setCurrentTime(\DateTime $currentTime): InfoAnswer
    {
        $this->currentTime = $currentTime;

        return $this;
    }

    /**
     * @return \DateInterval
     */
    public function getLengthTime(): \DateInterval
    {
        return $this->lengthTime;
    }

    /**
     * @param \DateInterval $lengthTime
     * @return InfoAnswer
     */
    public function setLengthTime(\DateInterval $lengthTime): InfoAnswer
    {
        $this->lengthTime = $lengthTime;

        return $this;
    }

    /**
     * @return string
     */
    public function getErrorReason(): string
    {
        return $this->errorReason;
    }

    /**
     * @param string $errorReason
     * @return InfoAnswer
     */
    public function setErrorReason(string $errorReason): InfoAnswer
    {
        $this->errorReason = $errorReason;

        return $this;
    }




}