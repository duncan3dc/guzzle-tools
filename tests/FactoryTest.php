<?php

namespace duncan3dc\GuzzleTests;

use duncan3dc\Guzzle\Factory;
use duncan3dc\Guzzle\Logger;
use duncan3dc\Guzzle\MessageFormatter;
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

class FactoryTest extends TestCase
{


    public function testGetClient()
    {
        $client = Factory::getClient();
        $this->assertInstanceOf(Client::class, $client);
    }


    /**
     * Ensure that by default our stack includes the logger.
     */
    public function testGetStack1()
    {
        $stack = Factory::getStack();

        $client = new Client([
            "handler" => $stack,
        ]);

        $this->expectOutputRegex("/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<</");
        $client->request("GET", "https://google.com/");
    }


    public function testGetMiddleware()
    {
        $middleware = Factory::getMiddleware();
        $this->assertInstanceOf(\Closure::class, $middleware);
    }


    public function testGetLogger()
    {
        $logger = Factory::getLogger();
        $this->assertInstanceOf(Logger::class, $logger);
    }


    public function testGetMessageFormatter()
    {
        $message = Factory::getMessageFormatter();
        $this->assertInstanceOf(MessageFormatter::class, $message);
    }


    public function testRequest()
    {
        $message = Factory::request("GET", "https://example.com/");
        $this->assertInstanceOf(RequestInterface::class, $message);
    }
}
