<?php

namespace duncan3dc\Guzzle;

use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;

class Logger implements LoggerInterface
{
    use LoggerTrait;

    /**
     * @param array<string, string> $context
     */
    public function log($level, $message, array $context = []): void
    {
        echo $message;
    }
}
