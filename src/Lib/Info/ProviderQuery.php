<?php


namespace App\Lib\Info;


class ProviderQuery implements ProviderTypeInterface
{
    private $type;

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }


    public function getDataProviderType(): string
    {
        return $this->type;
    }

}