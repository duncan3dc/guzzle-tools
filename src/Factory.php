<?php

namespace duncan3dc\Guzzle;

use GuzzleHttp\Client;

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
}
