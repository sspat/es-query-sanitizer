<?php
namespace sspat\ESQuerySanitizer\Tests;

use PHPUnit\Framework\TestCase;
use sspat\ESQuerySanitizer\Sanitizer;

class SanitizerTest extends TestCase
{
    public function testSpecialCharactersEscaped()
    {
        $unescapedQuery = '+-=&&||><!(){}[]^"~*?\:/ AND OR NOT';
        $expectedEscapedQuery = '\+\-\=\&\&\|\|\>\<\!\(\)\{\}\[\]\^\"\~\*\?\\\:\/\ \A\N\D\ \O\R\ \N\O\T';

        $escapedQuery = Sanitizer::escape($unescapedQuery);

        $this->assertSame($expectedEscapedQuery, $escapedQuery);
    }

    public function testExcludedCharactersNotEscaped()
    {
        $unescapedQuery = '+-=&&||><!(){}[]^"~*?\:/ AND OR NOT';
        $expectedEscapedQuery = '+\-\=\&\&\|\|\>\<\!\(\){\}\[\]\^\"\~\*\?\\\:\/\ \A\N\D\ \O\R\ \N\O\T';
        $excludedCharacters = ['+', '{'];

        $escapedQuery = Sanitizer::escape($unescapedQuery, $excludedCharacters);

        $this->assertSame($expectedEscapedQuery, $escapedQuery);
    }

    public function testExceptionThrownIfArgumentNotString()
    {
        $this->expectException('\sspat\ESQuerySanitizer\SanitizerException');

        Sanitizer::escape([]);
    }
}
