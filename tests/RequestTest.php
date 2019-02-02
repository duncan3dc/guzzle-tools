<?php

namespace duncan3dc\GuzzleTests;

use duncan3dc\Guzzle\Request;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    private $request;

    public function setUp()
    {
        $this->request = Request::make("GET", "http://example.com", [
            "headers"       =>  [
                "User-Agent"    =>  "superbrowser/1.0",
            ],
        ]);
    }


    public function testMethod()
    {
        $this->assertSame("GET", $this->request->getMethod());
    }


    public function testUri()
    {
        $this->assertSame("http://example.com", (string) $this->request->getUri());
    }


    public function testUserAgent()
    {
        $this->assertSame("superbrowser/1.0", $this->request->getHeader("user-agent")[0]);
    }


    public function testFormParams()
    {
        $request = Request::make("POST", "http://example.com", [
            "form_params"   =>  [
                "key1"  =>  "val1",
                "key2"  =>  "val2",
            ],
        ]);

        $this->assertSame("key1=val1&key2=val2", (string) $request->getBody());
        $this->assertSame("application/x-www-form-urlencoded", $request->getHeader("content-type")[0]);
    }


    public function testJson()
    {
        $request = Request::make("POST", "http://example.com", [
            "json"   =>  [
                "key1"  =>  "val1",
                "key2"  =>  "val2",
            ],
        ]);

        $this->assertSame('{"key1":"val1","key2":"val2"}', (string) $request->getBody());
        $this->assertSame("application/json", $request->getHeader("content-type")[0]);
    }


    public function testBody()
    {
        $request = Request::make("POST", "http://example.com", [
            "body"  =>  "Hello There!",
        ]);

        $this->assertSame("Hello There!", (string) $request->getBody());
    }


    public function testQuery()
    {
        $request = Request::make("GET", "http://example.com", [
            "query" =>  [
                "key1"  =>  "val1",
                "key2"  =>  "val2",
            ],
        ]);

        $this->assertSame("http://example.com?key1=val1&key2=val2", (string) $request->getUri());
    }
}
