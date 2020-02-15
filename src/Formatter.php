<?php namespace Sikei\Dns;

class Formatter
{
    static public function format(string $string): string
    {
        return str_replace(' ', "\t", $string);
    }
}
