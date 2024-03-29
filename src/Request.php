<?php

namespace duncan3dc\Guzzle;

use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\Utils;
use Psr\Http\Message\RequestInterface;

use function http_build_query;
use function is_array;

class Request
{
    /**
     * Create a new request instance from an options array.
     *
     * @param string $method The HTTP method to use
     * @param string $uri The URI to hit
     * @param array<string, mixed> $options The options to build the request with
     *
     * @return RequestInterface
     */
    public static function make(string $method, string $uri, array $options = []): RequestInterface
    {
        if (isset($options["headers"])) {
            $headers = $options["headers"];
            unset($options["headers"]);
        } else {
            $headers = [];
        }

        if (isset($options["body"])) {
            $body = $options["body"];
            unset($options["body"]);
        } else {
            $body = null;
        }

        if (isset($options["version"])) {
            $version = $options["version"];
            unset($options["version"]);
        } else {
            $version = "1.1";
        }

        $request = new Psr7\Request($method, $uri, $headers, $body, $version);

        $request = self::applyOptions($request, $options);

        return $request;
    }


    /**
     * Apply an array of options to a request instance.
     *
     * @param RequestInterface $request The request to modify
     * @param array<string, mixed> $options The options to apply
     *
     * @return RequestInterface
     */
    private static function applyOptions(RequestInterface $request, array $options): RequestInterface
    {
        $modify = [];

        if (isset($options["form_params"])) {
            $options["body"] = http_build_query($options["form_params"], "", "&");
            if (!$request->hasHeader("content-type")) {
                $modify["set_headers"] = ["content-type" => "application/x-www-form-urlencoded"];
            }
        }

        if (isset($options["json"])) {
            $options["body"] = \GuzzleHttp\json_encode($options["json"]);
            if (!$request->hasHeader("content-type")) {
                $modify["set_headers"] = ["content-type" => "application/json"];
            }
        }

        if (isset($options["body"])) {
            $modify["body"] = Utils::streamFor($options["body"]);
        }

        if (isset($options["query"])) {
            $value = $options["query"];
            if (is_array($value)) {
                $value = http_build_query($value, "", "&", PHP_QUERY_RFC3986);
            }
            $modify["query"] = $value;
        }

        return Utils::modifyRequest($request, $modify);
    }
}
