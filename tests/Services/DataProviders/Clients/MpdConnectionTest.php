<?php


namespace App\Tests\Services\DataProviders\Clients;


use App\Lib\Exceptions\MPDConnectionException;
use App\Services\DataProviders\Clients\MPDConnection;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MpdConnectionTest extends WebTestCase
{
    public function testConnection()
    {
        static::bootKernel();
        $config = static::$container->getParameter('app.sources');
        if ($config['type'] === 'yaml') {
            foreach ($config['sources'] as $source) {
                foreach ($source['informers'] as $informer) {
                    if ($informer['type'] === 'mpd') {
                        $url = $informer['url'];
                        $password = $informer['password'];
                        break 2;
                    }
                }
            }
            $connection = new MPDConnection();
            if (!isset($url, $password)) {
                throw new \UnexpectedValueException('No data for mpd test!');
            }
            $connection->setConfig($url, $password);
            $connection->connect();
            $this->assertTrue($connection->isConnected());
            $connection->disconnect();
            $wrongPass = 'wrongPass';
            $connection->setConfig($url, $wrongPass);
            $this->expectException(MPDConnectionException::class);
            $this->expectExceptionMessage('Password is incorrect.');
            $connection->connect();
            $connection->disconnect();
        }

    }

    public function testFailConnection()
    {
        $connection = new MPDConnection();
        $connection->setConfig('localhost:9999', '');
        $this->expectException(MPDConnectionException::class);
        $this->expectExceptionMessage('No connection to url localhost');
        $connection->connect();
    }
}