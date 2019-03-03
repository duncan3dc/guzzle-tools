<?php

namespace duncan3dc\GuzzleTests;

use duncan3dc\Guzzle\Http;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class HttpTest extends TestCase
{
    /** @var ClientInterface&MockInterface */
    private $client;


    /**
     * @inheritdoc
     */
    public function setUp(): void
    {
        # First make sure getClient() works
        $this->assertInstanceOf(ClientInterface::class, Http::getClient());

        # Override the client with our mock instance
        $this->client = Mockery::mock(ClientInterface::class);
        Http::setClient($this->client);
    }


    /**
     * @inheritdoc
     */
    public function tearDown(): void
    {
        Http::useragent("");
    }


    /**
     * Ensure the client is set/retrieved correctly.
     */
    public function testGetClient1(): void
    {
        $result = Http::getClient();
        $this->assertSame($this->client, $result);
    }


    /**
     * Ensure a custom request is handled correctly.
     */
    public function testRequest1(): void
    {
        $response = new Response(200, [], "BODY_CUSTOM_1");

        $this->client->shouldReceive("request")->once()
            ->with("CUSTOM", "http://example.com", [])
            ->andReturn($response);

        $result = Http::request("CUSTOM", "http://example.com");
        $this->assertSame("BODY_CUSTOM_1", $result);
    }


    /**
     * Ensure the user agent is passed for custom requests.
     */
    public function testRequest2(): void
    {
        $response = new Response(200, [], "BODY_CUSTOM_2");

        $this->client->shouldReceive("request")->once()
            ->with("CUSTOM", "http://example.com", [
                "headers" => ["User-Agent" => "example/user-agent"],
            ])
            ->andReturn($response);

        Http::useragent("example/user-agent");
        $result = Http::request("CUSTOM", "http://example.com");
        $this->assertSame("BODY_CUSTOM_2", $result);
    }


    /**
     * Ensure a basic GET request is handled correctly.
     */
    public function testGet1(): void
    {
        $response = new Response(200, [], "BODY_GET_1");

        $this->client->shouldReceive("request")->once()
            ->with("GET", "http://example.com", [
                "query" => [],
            ])
            ->andReturn($response);

        $result = Http::get("http://example.com");
        $this->assertSame("BODY_GET_1", $result);
    }


    /**
     * Ensure a query parameters are handled.
     */
    public function testGet2(): void
    {
        $response = new Response(200, [], "BODY_GET_2");

        $this->client->shouldReceive("request")->once()
            ->with("GET", "http://example.com", [
                "query" => ["one" => 1, "two" => 2],
            ])
            ->andReturn($response);

        $result = Http::get("http://example.com", ["one" => 1, "two" => 2]);
        $this->assertSame("BODY_GET_2", $result);
    }


    /**
     * Ensure the user agent is passed for GET requests.
     */
    public function testGet3(): void
    {
        $response = new Response(200, [], "BODY_GET_3");

        $this->client->shouldReceive("request")->once()
            ->with("GET", "http://example.com", [
                "query" => [],
                "headers" => ["User-Agent" => "example/user-agent"],
            ])
            ->andReturn($response);

        Http::useragent("example/user-agent");
        $result = Http::get("http://example.com");
        $this->assertSame("BODY_GET_3", $result);
    }


    /**
     * Ensure a basic POST request is handled correctly.
     */
    public function testPost1(): void
    {
        $response = new Response(200, [], "BODY_POST_1");

        $this->client->shouldReceive("request")->once()
            ->with("POST", "http://example.com", [
                "form_params" => [],
            ])
            ->andReturn($response);

        $result = Http::post("http://example.com");
        $this->assertSame("BODY_POST_1", $result);
    }


    /**
     * Ensure post parameters are handled.
     */
    public function testPost2(): void
    {
        $response = new Response(200, [], "BODY_POST_2");

        $this->client->shouldReceive("request")->once()
            ->with("POST", "http://example.com", [
                "form_params" => ["one" => 1, "two" => 2],
            ])
            ->andReturn($response);

        $result = Http::post("http://example.com", ["one" => 1, "two" => 2]);
        $this->assertSame("BODY_POST_2", $result);
    }


    /**
     * Ensure the user agent is passed for POST requests.
     */
    public function testPost3(): void
    {
        $response = new Response(200, [], "BODY_POST_3");

        $this->client->shouldReceive("request")->once()
            ->with("POST", "http://example.com", [
                "form_params" => [],
                "headers" => ["User-Agent" => "example/user-agent"],
            ])
            ->andReturn($response);

        Http::useragent("example/user-agent");
        $result = Http::post("http://example.com");
        $this->assertSame("BODY_POST_3", $result);
    }
}
