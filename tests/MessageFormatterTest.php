<?php

namespace duncan3dc\GuzzleTests;

use duncan3dc\Guzzle\MessageFormatter;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class MessageFormatterTest extends TestCase
{

    public function testFormatRequest()
    {
        $message = new MessageFormatter;

        $request = new Request("POST", "http://example.com/", [
            "Header1"   =>  "One",
        ], "body");

        $expected = [
            "<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<",
            "POST / HTTP/1.1",
            "Host: example.com",
            "Header1: One",
            "",
            "body",
            ">>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>",
            "",
        ];

        $result = $message->format($request);
        $lines = preg_split("/\r?\n/", $result);

        $this->assertSame($expected, $lines);
    }


    public function testFormatRequestAndResponse()
    {
        $message = new MessageFormatter;

        $request = new Request("POST", "http://example.com/", [
            "Header1"   =>  "One",
        ], "body");

        $response = new Response(404, [
            "Format"    =>  "JSON",
        ], "no-text");

        $expected = [
            "<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<",
            "POST / HTTP/1.1",
            "Host: example.com",
            "Header1: One",
            "",
            "body",
            "--------------------------------------------------------------------------------",
            "HTTP/1.1 404 Not Found",
            "Format: JSON",
            "",
            "no-text",
            ">>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>",
            "",
        ];

        $result = $message->format($request, $response);
        $lines = preg_split("/\r?\n/", $result);

        $this->assertSame($expected, $lines);
    }
}
