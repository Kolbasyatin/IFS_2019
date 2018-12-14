<?php


namespace App\Entity;


class Source
{
    /** @var string */
    private $name;

    /** @var int|null */
    private $priority;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Source
     */
    public function setName(string $name): Source
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPriority(): ?int
    {
        return $this->priority;
    }

    /**
     * @param int|null $priority
     * @return Source
     */
    public function setPriority(?int $priority): Source
    {
        $this->priority = $priority;

        return $this;
    }


}