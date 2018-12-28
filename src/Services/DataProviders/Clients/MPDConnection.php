<?php


namespace App\Services\DataProviders\Clients;


use App\Lib\Exceptions\MPDConnectionException;

/**
 * Class MPDConnection
 * @package App\Services\DataProviders\Clients
 */
class MPDConnection
{
    /**
     * @var
     */
    private $socket;

    /** @var string */
    private $url;

    /** @var string */
    private $password;

    /**
     * MPDConnection constructor.
     * @param string $url
     * @param string $password
     */
    public function __construct(string $url, string $password)
    {
        $this->password = $password;
        $this->url = $url;
    }


    /**
     * @param string|array $command
     * @return array
     * @throws MPDConnectionException
     */
    public function send($command): array
    {
        if (!$this->isConnected()) {
            $this->connect();

        }
        if (!is_array($command)) {
            $command = (array)$command;
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
        ['host' => $url, 'port' => $port] = parse_url($this->url);
        $this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if (false === socket_connect($this->socket, $url, $port)) {
            throw new MPDConnectionException('No connection  to url '.$url);
        }
        $this->skipFirstAnswer();
        if ($this->password) {
            $this->sendPassword();
            $answer = $this->receiveAnswer();
            $err = 'ACK [3@0]';
            if (strncmp($err, trim(end($answer)), strlen($err)) === 0) {
                $this->disconnect();
                throw new MPDConnectionException('Password is incorrect.');
            }
        }



    }

    /**
     * @throws MPDConnectionException
     */
    private function sendPassword(): void
    {
        if ($this->password) {
            $this->sendQuestion((array)sprintf('password %s', $this->password));
        }
    }

    /**
     * @throws MPDConnectionException
     */
    private function skipFirstAnswer(): void
    {
        $this->receiveAnswer();
    }

    /**
     * @param array $questionArray
     * @throws MPDConnectionException
     */
    private function sendQuestion(array $questionArray): void
    {
        $question = implode("\n", $questionArray) . "\n";
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