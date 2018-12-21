<?php


namespace App\Services\DataProviders\Clients;


use App\Lib\Exceptions\MPDConnectionException;

/**
 * Class MPDConnection
 * @package App\Services\DataProviders\Clients
 * @internal $command status
 * @internal $command info
 */
class MPDConnection
{

    /**
     * @var
     */
    private $socket;

    /** @var string */
    private $login;

    /** @var string */
    private $password;

    /** @var string */
    private $url;

    /**
     * @param string $address
     * @param string $login
     * @param string $password
     */
    public function configure(string $address, string $login, string $password): void
    {
        $this->url = $address;
        $this->login = $login;
        $this->password = $password;
    }

    /**
     * @param string $command
     * @return string
     * @throws MPDConnectionException
     */
    public function send(string $command): array
    {
        if (!$this->isConnected()) {
            $this->connect();

        }

        $this->sendQuestion($command);
        $data = $this->receiveAnswer();

        if ($this->isConnected()) {
            $this->disconnect();
        }

        return $data;
    }


    /**
     * @return bool
     */
    public function isConnected(): bool
    {
        return (bool)$this->socket;
    }

    /**
     *
     */
    public function disconnect(): void
    {
        if (null !== $this->socket) {
            socket_close($this->socket);
        }
    }

    /**
     * @throws MPDConnectionException
     */
    public function connect(): void
    {
        [$url, $port] = explode(':', $this->url);
        $this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if (false === socket_connect($this->socket, $url, $port)) {
            throw new MPDConnectionException('No connection  to url '.$url);
        }
        $this->skipFirstAnswer();
        $this->sendPassword();
        $answer = $this->receiveAnswer();
        $err = 'ACK [3@0]';
        if (strncmp($err, trim(end($answer)), strlen($err)) === 0) {
            throw new MPDConnectionException('Password is error');
        }

    }

    private function sendPassword(): void
    {
        if ($this->password) {
            $this->sendQuestion(sprintf('password %s', $this->password));
        }
    }

    /**
     * @throws MPDConnectionException
     */
    private function skipFirstAnswer(): void
    {
        $this->receiveAnswer();
    }

    private function sendQuestion(string $question): void
    {
        $question .= "\n";
        $result = socket_write($this->socket, $question, 1024);
        if (false === $result) {
            throw new MPDConnectionException('Can not write to socket!');
        }
    }

    /**
     * @return array|null
     * @throws MPDConnectionException
     */
    private function receiveAnswer(): ?array
    {
        while ($this->socket) {
            $answer = socket_read($this->socket, 1024);
            $result = explode("\n", trim($answer));
            if ($this->checkIfAnswerGotten(end($result))) {
                return $result;
            }
        }
        throw new MPDConnectionException('You never see this exception.');
    }

    /**
     * @param string $answer
     * @return bool
     */
    private function checkIfAnswerGotten(string $answer): bool
    {
        return (strncmp('OK', $answer, strlen('OK')) === 0) || (strncmp('ACK', $answer, strlen('ACK')) === 0);

    }
}