<?php

namespace duncan3dc\GuzzleTests;

use duncan3dc\Guzzle\Factory;
use duncan3dc\Guzzle\Logger;
use duncan3dc\Guzzle\MessageFormatter;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;

class FactoryTest extends \PHPUnit_Framework_TestCase
{

    public function testGetClient()
    {
        $client = Factory::getClient();
        $this->assertInstanceOf(Client::class, $client);
    }


    public function testGetStack()
    {
        $stack = Factory::getStack();
        $this->assertInstanceOf(HandlerStack::class, $stack);
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
}
