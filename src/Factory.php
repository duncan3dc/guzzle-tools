<?php

namespace duncan3dc\Guzzle;

use GuzzleHttp\Client;
use Psr\Http\Message\RequestInterface;

class Factory
{
    public static function getClient()
    {
        $stack = self::getStack();
        return new Client(["handler" => $stack]);
    }


    public static function getStack()
    {
        $stack = \GuzzleHttp\HandlerStack::create();
        $stack->push(self::getMiddleware());
        return $stack;
    }


    public static function getMiddleware()
    {
        return \GuzzleHttp\Middleware::log(self::getLogger(), self::getMessageFormatter());
    }


    public static function getLogger()
    {
        return new Logger;
    }


    public static function getMessageFormatter()
    {
        return new MessageFormatter;
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
    public static function request($method, $uri, array $options = [])
    {
        return Request::make($method, $uri, $options);
    }
}
