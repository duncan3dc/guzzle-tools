<?php

namespace duncan3dc\GuzzleTests;

use duncan3dc\Guzzle\Logger;
use PHPUnit\Framework\TestCase;

class LoggerTest extends TestCase
{

    public function testLog()
    {
        $logger = new Logger;

        $this->expectOutputString("Ok");
        $logger->log(0, "Ok");
    }
}
