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
    public function testGetClient(): void
    {
        $client = Factory::getClient();
        $this->assertInstanceOf(Client::class, $client);

        $this->expectOutputRegex("/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<</");
        $client->request("GET", "https://google.com/");
    }


    /**
     * Ensure that by default our stack includes the logger.
     */
    public function testGetStack1(): void
    {
        $stack = Factory::getStack();

        $client = new Client([
            "handler" => $stack,
        ]);

        $this->expectOutputRegex("/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<</");
        $client->request("GET", "https://google.com/");
    }


    public function testGetMiddleware(): void
    {
        $middleware = Factory::getMiddleware();
        $this->assertInstanceOf(\Closure::class, $middleware);
    }


    public function testGetLogger(): void
    {
        $logger = Factory::getLogger();
        $this->assertInstanceOf(Logger::class, $logger);
    }


    public function testGetMessageFormatter(): void
    {
        $message = Factory::getMessageFormatter();
        $this->assertInstanceOf(MessageFormatter::class, $message);
    }


    public function testRequest(): void
    {
        $message = Factory::request("GET", "https://example.com/");
        $this->assertInstanceOf(RequestInterface::class, $message);
    }
}
