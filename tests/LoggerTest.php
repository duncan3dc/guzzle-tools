<?php

namespace duncan3dc\GuzzleTests;

use duncan3dc\Guzzle\Logger;

class LoggerTest extends \PHPUnit_Framework_TestCase
{

    public function testLog()
    {
        $logger = new Logger;

        $this->expectOutputString("Ok");
        $logger->log(0, "Ok");
    }
}
