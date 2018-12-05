<?php


namespace App\Services\DataProviders\Factories;


class ProviderConfig implements ProviderConfigInterface
{

    /** @var string */
    private $source;

    /** @var string */
    private $type;

    /** @var string */
    private $login;

    /** @var string */
    private $password;

    /** @var string */
    private $address;

    /**
     * @return string
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * @param string $source
     * @return ProviderConfig
     */
    public function setSource(string $source): ProviderConfig
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
     * @param string $address
     * @return ProviderConfig
     */
    public function setAddress(string $address): ProviderConfig
    {
        $this->address = $address;

        return $this;
    }

    public function getProviderType(): string
    {
        return $this->type;
    }

    public function getAddress(): string
    {
        return $this->address;
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
            ->setAddress($url)
            ->setLogin($login)
            ->setPassword($password);

        return $instance;
    }


}