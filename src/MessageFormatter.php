<?php

namespace duncan3dc\Guzzle;

use GuzzleHttp\Psr7;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

use function str_repeat;
use function trim;

class MessageFormatter extends \GuzzleHttp\MessageFormatter
{
    public function format(RequestInterface $request, ResponseInterface $response = null, \Exception $error = null)
    {
        $message = str_repeat("<", 80) . "\n";

        $message .= trim(Psr7\str($request)) . "\n";

        if ($response) {
            $message .= "--------------------------------------------------------------------------------\n";
            $message .= trim(Psr7\str($response)) . "\n";
        }

        $message .= str_repeat(">", 80) . "\n";

        return $message;
    }
}
