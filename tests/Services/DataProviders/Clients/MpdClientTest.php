<?php


namespace App\Tests\Services\DataProviders\Clients;


use App\Lib\Exceptions\MPDConnectionException;
use App\Services\DataProviders\Clients\MpdClient;
use App\Services\DataProviders\Clients\MPDConnection;
use PHPUnit\Framework\TestCase;

class MpdClientTest extends TestCase
{
    public function testSuccessCommand()
    {
        $data = ['OK fake result'];
        $connection = $this->createMock(MPDConnection::class);
        $connection
            ->expects($this->once())
            ->method('send')
            ->willReturn($data)
        ;

        $client = new MpdClient($connection);
        $actual = $client->status();
        $this->assertEquals($data, $actual);
    }

    public function testFailCommand()
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
}