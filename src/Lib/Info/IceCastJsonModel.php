<?php


namespace App\Lib\Info;


use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints\DateTime;

class IceCastJsonModel
{
    /** @var string|null
     */
    private $audioInfo;

    /** @var int|null */
    private $channels;

    /** @var string|null */
    private $genre;

    /** @var int|null */
    private $listenerPeak;

    /** @var int|null */
    private $listeners;

    /** @var string|null */
    private $listenUrl;

    /** @var int|null */
    private $sampleRate;

    /** @var string|null */
    private $serverDescription;

    /** @var string|null */
    private $serverName;

    /** @var string|null */
    private $serverType;

    /** @var \DateTime|null */
    private $streamStart;

    /** @var \DateTime|null */
    private $streamStartIso8601;

    /** @var string|null */
    private $title;

    /** @var string|null */
    private $dummy;

    /**
     * @return string|null
     */
    public function getAudioInfo(): ?string
    {
        return $this->audioInfo;
    }

    /**
     * @param string|null $audioInfo
     * @return IceCastJsonModel
     */
    public function setAudioInfo(?string $audioInfo): IceCastJsonModel
    {
        $this->audioInfo = $audioInfo;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getChannels(): ?int
    {
        return $this->channels;
    }

    /**
     * @param string|null $channels
     * @return IceCastJsonModel
     */
    public function setChannels(?int $channels): IceCastJsonModel
    {
        $this->channels = $channels;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getGenre(): ?string
    {
        return $this->genre;
    }

    /**
     * @param string|null $genre
     * @return IceCastJsonModel
     */
    public function setGenre(?string $genre): IceCastJsonModel
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getListenerPeak(): ?int
    {
        return $this->listenerPeak;
    }

    /**
     * @param int|null $listenerPeak
     * @return IceCastJsonModel
     */
    public function setListenerPeak(?int $listenerPeak): IceCastJsonModel
    {
        $this->listenerPeak = $listenerPeak;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getListeners(): ?int
    {
        return $this->listeners;
    }

    /**
     * @param string|null $listeners
     * @return IceCastJsonModel
     */
    public function setListeners(?int $listeners): IceCastJsonModel
    {
        $this->listeners = $listeners;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getListenUrl(): ?string
    {
        return $this->listenUrl;
    }

    /**
     * @param string|null $listenUrl
     * @return IceCastJsonModel
     */
    public function setListenUrl(?string $listenUrl): IceCastJsonModel
    {
        $this->listenUrl = $listenUrl;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getSampleRate(): ?int
    {
        return $this->sampleRate;
    }

    /**
     * @param int|null $sampleRate
     * @return IceCastJsonModel
     */
    public function setSampleRate(?int $sampleRate): IceCastJsonModel
    {
        $this->sampleRate = $sampleRate;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getServerDescription(): ?string
    {
        return $this->serverDescription;
    }

    /**
     * @param string|null $serverDescription
     * @return IceCastJsonModel
     */
    public function setServerDescription(?string $serverDescription): IceCastJsonModel
    {
        $this->serverDescription = $serverDescription;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getServerName(): ?string
    {
        return $this->serverName;
    }

    /**
     * @param string|null $serverName
     * @return IceCastJsonModel
     */
    public function setServerName(?string $serverName): IceCastJsonModel
    {
        $this->serverName = $serverName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getServerType(): ?string
    {
        return $this->serverType;
    }

    /**
     * @param string|null $serverType
     * @return IceCastJsonModel
     */
    public function setServerType(?string $serverType): IceCastJsonModel
    {
        $this->serverType = $serverType;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getStreamStart(): ?\DateTime
    {
        return $this->streamStart;
    }

    /**
     * @param \DateTime|null $streamStart
     * @return IceCastJsonModel
     */
    public function setStreamStart(?\DateTime $streamStart): IceCastJsonModel
    {
        $this->streamStart = $streamStart;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getStreamStartIso8601(): ?\DateTime
    {
        return $this->streamStartIso8601;
    }

    /**
     * @param \DateTime|null $streamStartIso8601
     * @return IceCastJsonModel
     */
    public function setStreamStartIso8601(?\DateTime $streamStartIso8601): IceCastJsonModel
    {
        $this->streamStartIso8601 = $streamStartIso8601;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return IceCastJsonModel
     */
    public function setTitle(?string $title): IceCastJsonModel
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

    public function fillAnswer(InfoAnswer $answer): void
    {
        $answer
            ->setListeners($this->getListeners())
            ->setSongName($this->getTitle())

            ;
    }

}