<?php

namespace duncan3dc\GuzzleTests;

use duncan3dc\Guzzle\Request;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

class RequestTest extends TestCase
{
    /** @var RequestInterface */
    private $request;


    /**
     * @inheritdoc
     */
    public function setUp(): void
    {
        $this->request = Request::make("GET", "http://example.com", [
            "headers"       =>  [
                "User-Agent"    =>  "superbrowser/1.0",
            ],
        ]);
    }


    public function testMethod(): void
    {
        $this->assertSame("GET", $this->request->getMethod());
    }


    public function testUri(): void
    {
        $this->assertSame("http://example.com", (string) $this->request->getUri());
    }


    public function testUserAgent(): void
    {
        $this->assertSame("superbrowser/1.0", $this->request->getHeader("user-agent")[0]);
    }


    public function testFormParams(): void
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


    public function testJson(): void
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


    public function testBody(): void
    {
        $request = Request::make("POST", "http://example.com", [
            "body"  =>  "Hello There!",
        ]);

        $this->assertSame("Hello There!", (string) $request->getBody());
    }


    public function testQuery(): void
    {
        $request = Request::make("GET", "http://example.com", [
            "query" =>  [
                "key1"  =>  "val1",
                "key2"  =>  "val2",
            ],
        ]);

        $this->assertSame("http://example.com?key1=val1&key2=val2", (string) $request->getUri());
    }


    /**
     * Ensure we can override the content-type
     */
    public function testContentType1(): void
    {
        $request = Request::make("POST", "http://example.com", [
            "form_params"   =>  [
                "key1"  =>  "val1",
                "key2"  =>  "val2",
            ],
            "headers" => [
                "content-type" => "custom/format-1b",
            ],
        ]);
        $this->assertSame("custom/format-1b", $request->getHeader("content-type")[0]);
    }
}
