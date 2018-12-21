<?php


namespace App\Services\DataProviders\Clients;


use App\Lib\Exceptions\DataClientException;

class MpdClient
{

    public const STATUS = 'status';

    /** @var MPDConnection */
    private $connection;

    /**
     * MpdClient constructor.
     * @param MPDConnection $connection
     */
    public function __construct(MPDConnection $connection)
    {
        $this->connection = $connection;
    }


    public function setConfig(string $address, string $login, string $password): MpdClient
    {
        $this->connection->configure($address, $login, $password);

        return $this;
    }

    public function getStatus(): array
    {
        $command = self::STATUS;

        try {
            $data =  $this->connection->send($command);
            $a = 'b';
        } catch (\Exception $e) {
            throw new DataClientException('Error in MPD client data provider '.$e->getMessage());
        }

    }

}