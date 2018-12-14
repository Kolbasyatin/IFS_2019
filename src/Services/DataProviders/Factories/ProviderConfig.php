<?php


namespace App\Services\DataProviders\Factories;


use App\Entity\Source;

class ProviderConfig implements ProviderConfigInterface
{

    /** @var Source */
    private $source;

    /** @var string */
    private $type;

    /** @var string */
    private $login;

    /** @var string */
    private $password;

    /** @var string */
    private $url;

    /**
     * @return Source
     */
    public function getSource(): Source
    {
        return $this->source;
    }

    /**
     * @param Source $source
     * @return ProviderConfig
     */
    public function setSource(Source $source): ProviderConfig
    {
        $this->source = $source;

        return $this;
    }


    /**
     * @param string $type
     * @return ProviderConfig
     */
    public function setType(string $type): ProviderConfig
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param string $login
     * @return ProviderConfig
     */
    public function setLogin(string $login): ProviderConfig
    {
        $this->login = $login;

        return $this;
    }

    /**
     * @param string $password
     * @return ProviderConfig
     */
    public function setPassword(string $password): ProviderConfig
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @param string $url
     * @return ProviderConfig
     */
    public function setUrl(string $url): ProviderConfig
    {
        $this->url = $url;

        return $this;
    }

    public function getProviderType(): string
    {
        return $this->type;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public static function createInstance(string $source, string $type, string $url, string $login = '', string $password = ''): self
    {
        $instance = new static();
        $instance
            ->setSource($source)
            ->setType($type)
            ->setUrl($url)
            ->setLogin($login)
            ->setPassword($password);

        return $instance;
    }


}