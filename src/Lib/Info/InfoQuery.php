<?php


namespace App\Lib\Info;


class InfoQuery
{
    /** @var string */
    private $source;

    /** @var string */
    private $providerType;

    /**
     * @return string
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * @param string $source
     * @return InfoQuery
     */
    public function setSource(string $source): InfoQuery
    {
        $this->source = $source;

        return $this;
    }

    /**
     * @return string
     */
    public function getProviderType(): string
    {
        return $this->providerType;
    }

    /**
     * @param string $providerType
     */
    public function setProviderType(string $providerType): void
    {
        $this->providerType = $providerType;
    }


}