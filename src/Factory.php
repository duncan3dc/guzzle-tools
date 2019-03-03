<?php

namespace duncan3dc\Guzzle;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;
use Psr\Log\LoggerInterface;

class Factory
{
    public static function getClient(): ClientInterface
    {
        $stack = self::getStack();
        return new Client(["handler" => $stack]);
    }


    public static function getStack(): HandlerStack
    {
        $stack = HandlerStack::create();
        $stack->push(self::getMiddleware());
        return $stack;
    }


    public static function getMiddleware(): callable
    {
        return Middleware::log(self::getLogger(), self::getMessageFormatter());
    }


    public static function getLogger(): LoggerInterface
    {
        return new Logger();
    }


    public static function getMessageFormatter(): MessageFormatter
    {
        return new MessageFormatter();
    }


    /**
     * Create a new request instance from an options array.
     *
     * @param string $method The HTTP method to use
     * @param string $uri The URI to hit
     * @param array $options The options to build the request with
     *
     * @return RequestInterface
     */
    public static function request(string $method, string $uri, array $options = []): RequestInterface
    {
        return Request::make($method, $uri, $options);
    }
}
