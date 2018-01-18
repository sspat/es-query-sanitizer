<?php
namespace sspat\ESQuerySanitizer;

class Sanitizer
{
    /**
     * Escapes reserved characters in a string
     *
     * @param $query
     * @param array|null $exclude
     * @return string
     */
    public static function escape($query, array $exclude = null)
    {
        self::ensureString($query);

        return str_ireplace(
            self::reservedCharacters($exclude),
            array_keys(self::reservedCharacters($exclude)),
            $query
        );
    }

    /**
     * Checks if argument is a string
     *
     * @param mixed $variable
     * @return void
     * @throws SanitizerException
     */
    protected static function ensureString($variable)
    {
        if (is_string($variable)) {
            return;
        }

        throw new SanitizerException('Query must be a string');
    }

    /**
     * Returns array of ElasticSearch reserved characters.
     * Characters can be excluded from the result by passing them in the $exclude argument
     *
     * @param string[]|null $excludeCharacters
     * @return string[]
     */
    protected static function reservedCharacters(array $excludeCharacters = null)
    {
        $reservedCharacters = [
            "\\" => '\\',
            '\+' => '+',
            '\-' => '-',
            '\=' => '=',
            '\&\&' => '&&',
            '\|\|' => '||',
            '\>' => '>',
            '\<' => '<',
            '\!' => '!',
            '\(' => '(',
            '\)' => ')',
            '\{' => '{',
            '\}' => '}',
            '\[' => '[',
            '\]' => ']',
            '\^' => '^',
            '\"' => '"',
            '\~' => '~',
            '\*' => '*',
            '\?' => '?',
            '\:' => ':',
            '\/' => '/',
            '\A\N\D' => 'AND',
            '\O\R' => 'OR',
            '\N\O\T' => 'NOT',
            '\ ' => ' '
        ];

        if (is_array($excludeCharacters)) {
            $reservedCharacters = array_filter(
                $reservedCharacters,
                function ($reservedCharacter) use ($excludeCharacters) {
                    return !in_array($reservedCharacter, $excludeCharacters, true);
                }
            );
        }

        return $reservedCharacters;
    }

}
