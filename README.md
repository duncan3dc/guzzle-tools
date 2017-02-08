# guzzle-tools
A PHP library to log request and responses from [Guzzle](http://guzzlephp.org/).

[![Build Status](https://img.shields.io/travis/duncan3dc/guzzle-tools.svg)](https://travis-ci.org/duncan3dc/guzzle-tools)
[![Latest Version](https://img.shields.io/packagist/v/duncan3dc/guzzle-tools.svg)](https://packagist.org/packages/duncan3dc/guzzle-tools)


## Installation

The recommended method of installing this library is via [Composer](//getcomposer.org/).

Run the following command from your project root:

```bash
$ composer require duncan3dc/guzzle-tools
```


## Quick Examples

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


## Changelog
A [Changelog](CHANGELOG.md) has been available since the beginning of time


## Where to get help
Found a bug? Got a question? Just not sure how something works?  
Please [create an issue](//github.com/duncan3dc/guzzle-tools/issues) and I'll do my best to help out.  
Alternatively you can catch me on [Twitter](https://twitter.com/duncan3dc)
