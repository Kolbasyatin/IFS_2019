<?php


namespace App\Lib\Info;


class InfoQuery
{
    /** @var string */
    private $source;

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


}