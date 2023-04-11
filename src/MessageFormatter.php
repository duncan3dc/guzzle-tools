<?php

namespace duncan3dc\Guzzle;

use GuzzleHttp\MessageFormatterInterface;
use GuzzleHttp\Psr7\Message;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

use function str_repeat;
use function trim;

class MessageFormatter implements MessageFormatterInterface
{
    public function format(
        RequestInterface $request,
        ResponseInterface $response = null,
        \Throwable $error = null,
    ): string {
        $message = str_repeat("<", 80) . "\n";

        $message .= trim(Message::toString($request)) . "\n";

        if ($response) {
            $message .= "--------------------------------------------------------------------------------\n";
            $message .= trim(Message::toString($response)) . "\n";
        }

        $message .= str_repeat(">", 80) . "\n";

        return $message;
    }
}
