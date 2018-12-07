<?php


namespace App\Lib\Info;


use Symfony\Component\Validator\Constraints\DateTime;

class IceCastJsonModel
{
    /** @var string */
    private $audioInfo;

    /** @var int */
    private $channels;

    /** @var string */
    private $genre;

    /** @var int */
    private $listenerPeak;

    /** @var int */
    private $listeners;

    /** @var string */
    private $listenUrl;

    /** @var int */
    private $sampleRate;

    /** @var string */
    private $serverDescription;

    /** @var string */
    private $serverName;

    /** @var string */
    private $serverType;

//    /** @var \DateTime */
//    private $streamStart;

    /** @var \DateTime */
    private $streamStartIso8601;

    /** @var string */
    private $title;

    /** @var string|null */
    private $dummy;

    /**
     * IceCastJsonModel constructor.
     */
    public function __construct()
    {
        $this->streamStartIso8601 = new DateTime();
    }


    /**
     * @return string
     */
    public function getAudioInfo(): string
    {
        return $this->audioInfo;
    }

    /**
     * @param string $audioInfo
     * @return IceCastJsonModel
     */
    public function setAudioInfo(string $audioInfo): IceCastJsonModel
    {
        $this->audioInfo = $audioInfo;

        return $this;
    }

    /**
     * @return int
     */
    public function getChannels(): int
    {
        return $this->channels;
    }

    /**
     * @param int $channels
     * @return IceCastJsonModel
     */
    public function setChannels(int $channels): IceCastJsonModel
    {
        $this->channels = $channels;

        return $this;
    }

    /**
     * @return string
     */
    public function getGenre(): string
    {
        return $this->genre;
    }

    /**
     * @param string $genre
     * @return IceCastJsonModel
     */
    public function setGenre(string $genre): IceCastJsonModel
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * @return int
     */
    public function getListenerPeak(): int
    {
        return $this->listenerPeak;
    }

    /**
     * @param int $listenerPeak
     * @return IceCastJsonModel
     */
    public function setListenerPeak(int $listenerPeak): IceCastJsonModel
    {
        $this->listenerPeak = $listenerPeak;

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
     * @return IceCastJsonModel
     */
    public function setListeners(int $listeners): IceCastJsonModel
    {
        $this->listeners = $listeners;

        return $this;
    }

    /**
     * @return string
     */
    public function getListenUrl(): string
    {
        return $this->listenUrl;
    }

    /**
     * @param string $listenUrl
     * @return IceCastJsonModel
     */
    public function setListenUrl(string $listenUrl): IceCastJsonModel
    {
        $this->listenUrl = $listenUrl;

        return $this;
    }

    /**
     * @return int
     */
    public function getSampleRate(): int
    {
        return $this->sampleRate;
    }

    /**
     * @param int $sampleRate
     * @return IceCastJsonModel
     */
    public function setSampleRate(int $sampleRate): IceCastJsonModel
    {
        $this->sampleRate = $sampleRate;

        return $this;
    }

    /**
     * @return string
     */
    public function getServerDescription(): string
    {
        return $this->serverDescription;
    }

    /**
     * @param string $serverDescription
     * @return IceCastJsonModel
     */
    public function setServerDescription(string $serverDescription): IceCastJsonModel
    {
        $this->serverDescription = $serverDescription;

        return $this;
    }

    /**
     * @return string
     */
    public function getServerName(): string
    {
        return $this->serverName;
    }

    /**
     * @param string $serverName
     * @return IceCastJsonModel
     */
    public function setServerName(string $serverName): IceCastJsonModel
    {
        $this->serverName = $serverName;

        return $this;
    }

    /**
     * @return string
     */
    public function getServerType(): string
    {
        return $this->serverType;
    }

    /**
     * @param string $serverType
     * @return IceCastJsonModel
     */
    public function setServerType(string $serverType): IceCastJsonModel
    {
        $this->serverType = $serverType;

        return $this;
    }

//    /**
//     * @return \DateTime
//     */
//    public function getStreamStart(): \DateTime
//    {
//        return $this->streamStart;
//    }
//
//    /**
//     * @param \DateTime $streamStart
//     * @return IceCastJsonModel
//     */
//    public function setStreamStart(\DateTime $streamStart): IceCastJsonModel
//    {
//        $this->streamStart = $streamStart;
//
//        return $this;
//    }

    /**
     * @return \DateTime
     */
    public function getStreamStartIso8601(): \DateTime
    {
        return $this->streamStartIso8601;
    }

    /**
     * @param \DateTime $streamStartIso8601
     * @return IceCastJsonModel
     */
    public function setStreamStartIso8601(\DateTime $streamStartIso8601): IceCastJsonModel
    {
        $this->streamStartIso8601 = $streamStartIso8601;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return IceCastJsonModel
     */
    public function setTitle(string $title): IceCastJsonModel
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDummy(): ?string
    {
        return $this->dummy;
    }

    /**
     * @param string|null $dummy
     * @return IceCastJsonModel
     */
    public function setDummy(?string $dummy): IceCastJsonModel
    {
        $this->dummy = $dummy;

        return $this;
    }



}