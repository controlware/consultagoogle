<?php

namespace Source\Helpers;

class StringHelper
{
    public static function doRegex(string $text, string $rule)
    {
        preg_match_all($rule, $text, $result);

        return $result;
    }

    public static function replaceRegex(string $text, $regex, string $replace)
    {
        return preg_replace($regex, $replace, $text);
    }

    public static function cleanArrayText($array)
    {
        $array = self::removeAccentsFromArrayValeus($array);
        $array = self::removeSpecialCharsFromArrayValeus($array);
        $array = self::arrayValuesToUtf8($array);
        return $array;
    }

    public static function arrayValuesToUtf8($array)
    {
        array_walk_recursive($array, function (&$text) {
            if (is_string($text)) {
                $text = mb_convert_encoding($text, 'UTF-8', 'UTF-8');
            }
        });

        return $array;
    }

    public static function removeAccentsFromArrayValeus($array)
    {
        array_walk_recursive($array, function (&$text) {
            $text = preg_replace('/(@|#|\$|ª|º|\"|\')/i', '', $text);
            $text = trim(preg_replace(array('/(á|à|ã|â|ä)/', '/(Á|À|Ã|Â|Ä)/', '/(é|è|ê|ë)/', '/(É|È|Ê|Ë)/', '/(í|ì|î|ï)/', '/(Í|Ì|Î|Ï)/', '/(ó|ò|õ|ô|ö)/', '/(Ó|Ò|Õ|Ô|Ö)/', '/(ú|ù|û|ü)/', '/(Ú|Ù|Û|Ü)/', '/(ñ)/', '/(Ñ)/', '/(ç)/', '/(Ç)/'), explode(' ', 'a A e E i I o O u U n N c C'), $text));
        });

        return $array;
    }

    public static function removeHtmlCharsFromArrayValeus($array)
    {
        array_walk_recursive($array, function (&$text) {
            $text = strip_tags($text);
        });

        return $array;
    }

    public static function removeSpecialCharsFromArrayValeus($array)
    {
        array_walk_recursive($array, function (&$text) {
            $text = self::replaceRegex($text, '/\?/i', '');
        });

        return $array;
    }
}
