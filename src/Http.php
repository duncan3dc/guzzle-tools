<?php

namespace duncan3dc\Guzzle;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

use function array_key_exists;
use function is_array;

class Http
{
    /**
     * @var ?ClientInterface The underlying guzzle instance.
     */
    private static $client;

    /**
     * @var string The default user agent to use on requests.
     */
    private static $useragent;


    /**
     * Inject the guzzle instance to use.
     *
     * @param ClientInterface $client The underlying guzzle instance
     *
     * @return void
     */
    public static function setClient(ClientInterface $client): void
    {
        self::$client = $client;
    }


    /**
     * Get the guzzle instance in use.
     *
     * @return ClientInterface
     */
    public static function getClient(): ClientInterface
    {
        if (!self::$client) {
            self::$client = new Client();
        }

        return self::$client;
    }


    /**
     * Set the default useragent to use.
     *
     * @param string $useragent The user agent string to use
     *
     * @return void
     */
    public static function useragent(string $useragent): void
    {
        self::$useragent = $useragent;
    }


    /**
     * Send a request and get the body back as a string.
     *
     * @param string $method The HTTP method to use
     * @param string $url The URL to hit
     * @param array<string, mixed> $options Any additonal guzzle options to use
     *
     * @return string
     */
    public static function request(string $method, string $url, array $options = []): string
    {
        if (self::$useragent) {
            if (!array_key_exists("headers", $options) || !is_array($options["headers"])) {
                $options["headers"] = [];
            }
            $options["headers"]["User-Agent"] = self::$useragent;
        }

        $response = self::getClient()->request($method, $url, $options);

        return $response->getBody();
    }


    /**
     * Send a GET request and get the body back as a string.
     *
     * @param string $url The URL to hit
     * @param array<string, mixed> $params Any query params to send
     *
     * @return string
     */
    public static function get(string $url, array $params = []): string
    {
        return self::request("GET", $url, [
            "query" =>  $params,
        ]);
    }


    /**
     * Send a POST request and get the body back as a string.
     *
     * @param string $url The URL to hit
     * @param array<string, mixed> $params Any form params to send
     *
     * @return string
     */
    public static function post(string $url, array $params = []): string
    {
        return self::request("POST", $url, [
            "form_params"   =>  $params,
        ]);
    }
}
