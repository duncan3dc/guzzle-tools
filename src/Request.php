<?php

namespace duncan3dc\Guzzle;

use GuzzleHttp\Psr7;
use Psr\Http\Message\RequestInterface;
use function count;

class Request
{
    /**
     * Create a new request instance from an options array.
     *
     * @param string $method The HTTP method to use
     * @param string $uri The URI to hit
     * @param array $options The options to build the request with
     *
     * @return RequestInterface
     */
    public static function make($method, $uri, array $options = [])
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
     * @param array $options The options to apply
     *
     * @return RequestInterface
     */
    private static function applyOptions(RequestInterface $request, array $options)
    {
        $modify = [];
        $headers = [];

        if (isset($options["form_params"])) {
            $options["body"] = http_build_query($options["form_params"], "", "&");
            $headers["content-type"] = "application/x-www-form-urlencoded";
        }

        if (isset($options["json"])) {
            $options["body"] = \GuzzleHttp\json_encode($options["json"]);
            $headers["content-type"] = "application/json";
        }

        if (isset($options["body"])) {
            $modify["body"] = Psr7\stream_for($options["body"]);
        }

        if (isset($options["query"])) {
            $value = $options["query"];
            if (is_array($value)) {
                $value = http_build_query($value, "", "&", PHP_QUERY_RFC3986);
            }
            $modify["query"] = $value;
        }

        $set = [];
        foreach ($headers as $key => $val) {
            if ($request->hasHeader($key)) {
                continue;
            }
            $set[$key] = $val;
        }
        if (count($set) > 0) {
            $modify["set_headers"] = $set;
        }

        return Psr7\modify_request($request, $modify);
    }
}
