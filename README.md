# Simple helper class to sanitize ElasticSearch reserved characters from query strings
Inspired by [node-elasticsearch-sanitize](https://github.com/lanetix/node-elasticsearch-sanitize)

[![Author](https://img.shields.io/badge/author-@sspat-blue.svg?style=flat-square)](https://moikrug.ru/sspat)
[![GitHub tag](https://img.shields.io/github/tag/sspat/es-query-sanitizer.svg)]()
[![license](https://img.shields.io/github/license/mashape/apistatus.svg)](https://github.com/sspat/es-query-sanitizer/blob/master/LICENSE)

Features
--------
Accepts an arbitrary string as input and escapes the ElasticSearch reserved characters:

`+ - = && || > < ! ( ) { } [ ] ^ " ~ * ? : \ / AND OR NOT space`

Returns a sanitized string which can be safely used in an ElasticSearch query_string query.

Installation
------------
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require sspat/es-query-sanitizer
```

or add

```
"sspat/es-query-sanitizer": "~1.0"
```

to the require section of your `composer.json` file.

Usage
-----
To use pass in a string:

```php
$unescapedQueryString = 'AND there! are? (lots of) char*cters 2 ^escape!'
$escapedQueryString = \sspat\ESQuerySanitizer\Sanitizer::escape($unescapedQueryString);

echo $escapedQueryString; // \A\N\D\ there\!\ are\?\ \(lots\ of\)\ char\*cters\ 2\ \^escape\!
```

You can also pass an array as the second argument, if you want to prevent some characters from being escaped:
```php
$unescapedQueryString = 'AND there! are? (lots of) char*cters 2 ^escape!'
$excludeCharacters = ['!', '^'];
$escapedQueryString = \sspat\ESQuerySanitizer\Sanitizer::escape($unescapedQueryString, $excludeCharacters);

echo $escapedQueryString; // \A\N\D\ there!\ are\?\ \(lots\ of\)\ char\*cters\ 2\ ^escape!
```