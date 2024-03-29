# guzzle-tools
A PHP library offering some add-ons for [Guzzle](http://guzzlephp.org/).

[![release](https://poser.pugx.org/duncan3dc/guzzle-tools/version.svg)](https://packagist.org/packages/duncan3dc/guzzle-tools)
[![build](https://github.com/duncan3dc/guzzle-tools/workflows/.github/workflows/buildcheck.yml/badge.svg?branch=main)](https://github.com/duncan3dc/guzzle-tools/actions/workflows/coverage.yml)
[![coverage](https://codecov.io/gh/duncan3dc/guzzle-tools/graph/badge.svg)](https://codecov.io/gh/duncan3dc/guzzle-tools)


## Installation

The recommended method of installing this library is via [Composer](//getcomposer.org/).

Run the following command from your project root:

```bash
$ composer require duncan3dc/guzzle-tools
```


## Quick Examples

### Logging

When working with Guzzle I got bored of searching for the solution to output the request/response every time I wanted a quick debug, this library makes it easy:


```php
$client = \duncan3dc\Guzzle\Factory::getClient();

$client->request("GET", "http://example.com/");
```

Running the above would output this on the command line:
```
<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
GET / HTTP/1.1
User-Agent: GuzzleHttp/6.2.1 curl/7.47.0 PHP/7.1.0RC3
Host: example.com
--------------------------------------------------------------------------------
HTTP/1.1 200 OK
Cache-Control: max-age=604800
Content-Type: text/html
Date: Mon, 09 Jan 2017 14:42:17 GMT
Etag: "359670651+gzip+ident"
Expires: Mon, 16 Jan 2017 14:42:17 GMT
Last-Modified: Fri, 09 Aug 2013 23:54:35 GMT
Server: ECS (ewr/15BD)
Vary: Accept-Encoding
X-Cache: HIT
x-ec-custom-error: 1
Content-Length: 1270

<!doctype html>
<html>
<head>
    <title>Example Domain</title>
</head>
<body>
<div>
    <h1>Example Domain</h1>
    <p>This domain is established to be used for illustrative examples in documents. You may use this
    domain in examples without prior coordination or asking for permission.</p>
    <p><a href="http://www.iana.org/domains/example">More information...</a></p>
</div>
</body>
</html>
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
```

### Request Building

As of version 6.0.0 Guzzle no longer offers a way to build a request instance to send later, this library provides a simple workaround:

```php
$request = \duncan3dc\Guzzle\Request::make("GET", "https://example.com/", [
    "query" =>  [
        "date"  =>  date("Y-m-d"),
    ],
]);

# There's also an alias on the main factory class
$request = \duncan3dc\Guzzle\Factory::request("GET", "https://example.com/");
```

### Simple Requests

When all you need is a basic GET/POST, you can use the `Http` class:

```php
$response = \duncan3dc\Guzzle\Http::get("https://example.com/", [
    "date"  =>  date("Y-m-d"),
]);

$response = \duncan3dc\Guzzle\Http::post("https://example.com/", [
    "date"  =>  date("Y-m-d"),
]);
```


## Changelog
A [Changelog](CHANGELOG.md) has been available since the beginning of time


## Where to get help
Found a bug? Got a question? Just not sure how something works?  
Please [create an issue](//github.com/duncan3dc/guzzle-tools/issues) and I'll do my best to help out.  
Alternatively you can catch me on [Twitter](https://twitter.com/duncan3dc)


## duncan3dc/guzzle-tools for enterprise

Available as part of the Tidelift Subscription

The maintainers of duncan3dc/guzzle-tools and thousands of other packages are working with Tidelift to deliver commercial support and maintenance for the open source dependencies you use to build your applications. Save time, reduce risk, and improve code health, while paying the maintainers of the exact dependencies you use. [Learn more.](https://tidelift.com/subscription/pkg/packagist-duncan3dc-guzzle-tools?utm_source=packagist-duncan3dc-guzzle-tools&utm_medium=referral&utm_campaign=readme)
