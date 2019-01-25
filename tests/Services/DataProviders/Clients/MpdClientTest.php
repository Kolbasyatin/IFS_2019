<?php


namespace App\Tests\Services\DataProviders\Clients;


use App\Lib\Exceptions\MpdClientException;
use App\Lib\Exceptions\MPDConnectionException;
use App\Services\DataProviders\Clients\MpdClient;
use App\Services\DataProviders\Clients\MPDConnection;
use PHPUnit\Framework\TestCase;

class MpdClientTest extends TestCase
{
    public function testSuccessCommand()
    {
        $data = ['fake result', 'OK fake result answer'];
        $connection = $this->createMock(MPDConnection::class);
        $connection
            ->expects($this->once())
            ->method('send')
            ->willReturn($data)
        ;

        $client = new MpdClient($connection);
        $actual = $client->status();
        array_pop($data);
        $this->assertEquals($data, $actual);
    }

    public function testFailMPDConnection()
    {
        $connection = $this->createMock(MPDConnection::class);
        $connection
            ->expects($this->once())
            ->method('send')
            ->willThrowException(new MPDConnectionException())
        ;

        $client = new MpdClient($connection);
        $this->expectException(MPDConnectionException::class);
        $client->status();

    }

    public function testFailedCommand()
    {
        $data = ['ACK@300 fake result'];
        $connection = $this->createMock(MPDConnection::class);
        $connection
            ->expects($this->once())
            ->method('send')
            ->willReturn($data)
        ;

        $client = new MpdClient($connection);
        $this->expectException(MpdClientException::class);
        $client->status();
    }
}