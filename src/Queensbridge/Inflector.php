<?php

namespace Queensbridge;

/**
 * Class for handling inflection of words.
 */
class Inflector
{
    private static $plural = array(
        '/(quiz)$/i'               => "$1zes",
        '/^(ox)$/i'                => "$1en",
        '/([m|l])ouse$/i'          => "$1ice",
        '/(matr|vert|ind)ix|ex$/i' => "$1ices",
        '/(x|ch|ss|sh)$/i'         => "$1es",
        '/([^aeiouy]|qu)y$/i'      => "$1ies",
        '/(hive)$/i'               => "$1s",
        '/(?:([^f])fe|([lr])f)$/i' => "$1$2ves",
        '/(shea|lea|loa|thie)f$/i' => "$1ves",
        '/sis$/i'                  => "ses",
        '/([ti])um$/i'             => "$1a",
        '/(tomat|potat|ech|her|vet)o$/i'=> "$1oes",
        '/(bu)s$/i'                => "$1ses",
        '/(alias)$/i'              => "$1es",
        '/(octop)us$/i'            => "$1i",
        '/(ax|test)is$/i'          => "$1es",
        '/(us)$/i'                 => "$1es",
        '/s$/i'                    => "s",
        '/$/'                      => "s"
    );

    private static $singular = array(
        '/(quiz)zes$/i'             => "$1",
        '/(matr)ices$/i'            => "$1ix",
        '/(vert|ind)ices$/i'        => "$1ex",
        '/^(ox)en$/i'               => "$1",
        '/(alias)es$/i'             => "$1",
        '/(octop|vir)i$/i'          => "$1us",
        '/(cris|ax|test)es$/i'      => "$1is",
        '/(shoe)s$/i'               => "$1",
        '/(o)es$/i'                 => "$1",
        '/(bus)es$/i'               => "$1",
        '/([m|l])ice$/i'            => "$1ouse",
        '/(x|ch|ss|sh)es$/i'        => "$1",
        '/(m)ovies$/i'              => "$1ovie",
        '/(s)eries$/i'              => "$1eries",
        '/([^aeiouy]|qu)ies$/i'     => "$1y",
        '/([lr])ves$/i'             => "$1f",
        '/(tive)s$/i'               => "$1",
        '/(hive)s$/i'               => "$1",
        '/(li|wi|kni)ves$/i'        => "$1fe",
        '/(shea|loa|lea|thie)ves$/i'=> "$1f",
        '/(^analy)ses$/i'           => "$1sis",
        '/((a)naly|(b)a|(d)iagno|(p)arenthe|(p)rogno|(s)ynop|(t)he)ses$/i'  => "$1$2sis",
        '/([ti])a$/i'               => "$1um",
        '/(n)ews$/i'                => "$1ews",
        '/(h|bl)ouses$/i'           => "$1ouse",
        '/(corpse)s$/i'             => "$1",
        '/(us)es$/i'                => "$1",
        '/s$/i'                     => ""
    );

    private static $irregular = array(
        'move'   => 'moves',
        'foot'   => 'feet',
        'goose'  => 'geese',
        'sex'    => 'sexes',
        'child'  => 'children',
        'man'    => 'men',
        'tooth'  => 'teeth',
        'person' => 'people'
    );

    private static $uncountable = array(
        'sheep',
        'fish',
        'deer',
        'series',
        'species',
        'money',
        'rice',
        'information',
        'equipment'
    );

    /**
     * Pluralizes a word.
     *
     * @param string $string The singular word.
     *
     * @return string The pluralized word.
     */
    public static function pluralize($string)
    {
        $string = self::singularize($string);

        // save some time in the case that singular and plural are the same
        if (in_array(strtolower($string), self::$uncountable)) {
            return $string;
        }

        // check for irregular singular forms
        foreach (self::$irregular as $pattern => $result) {
            $pattern = '/' . $pattern . '$/i';

            if (preg_match($pattern, $string)) {
                return preg_replace($pattern, $result, $string);
            }
        }

        // check for matches using regular expressions
        foreach (self::$plural as $pattern => $result) {
            if (preg_match($pattern, $string)) {
                return preg_replace($pattern, $result, $string);
            }
        }

        return $string;
    }

    /**
     * Singularizes a plural word.
     *
     * @param string $string The plural word.
     *
     * @return string The singular word.
     */
    public static function singularize($string)
    {
        // save some time in the case that singular and plural are the same
        if (in_array(strtolower($string), self::$uncountable)) {
            return $string;
        }

        // check for irregular plural forms
        foreach (self::$irregular as $result => $pattern) {
            $pattern = '/' . $pattern . '$/i';

            if (preg_match($pattern, $string)) {
                return preg_replace($pattern, $result, $string);
            }
        }

        // check for matches using regular expressions
        foreach (self::$singular as $pattern => $result) {
            if (preg_match($pattern, $string)) {
                return preg_replace($pattern, $result, $string);
            }
        }

        return $string;
    }

    /**
     * Pluralizes a word if count is higher than one.
     *
     * @param int    $count  The count.
     * @param string $string The string to pluralize.
     *
     * @return string The pluralized string.
     */
    public static function pluralizeIf($count, $string)
    {
        if ($count == 1) {
            return "1 {$string}";
        } else {
            return $count . " " . self::pluralize($string);
        }
    }

    /**
     * Checks if word is plural.
     *
     * @param string $string The plural string.
     *
     * @return boolean True if string is plural.
     */
    public static function isPlural($string)
    {
        $plural = self::pluralize($string);

        return $plural === $string;
    }

    /**
     * Checks if word is singular.
     *
     * @param string $string The singular string.
     *
     * @return boolean True if string is singular.
     */
    public static function isSingular($string)
    {
        $singular = self::singularize($string);

        return $singular === $string;
    }

    /**
     * Create the name of a table. This method uses the
     * pluralize method on the last word in the string.
     *
     * @param  string $className The class name.
     * @return string The tablelized name.
     */
    public static function tableize($className)
    {
        return self::pluralize(self::underscore($className));
    }

    /**
     * Makes an underscored, lowercase form from the expression in the string.
     * @param  string $camelCasedWord The camel cased word.
     * @return string The underscored word.
     */
    public static function underscore($camelCasedWord)
    {
        $word = preg_replace('/([A-Z\d]+)([A-Z][a-z])/', '\1_\2', $camelCasedWord);
        $word = preg_replace('/([a-z\d])([A-Z])/', '\1_\2', $word);
        $word = str_replace(' ', '_', $word);
        $word = str_replace('-', '_', $word);
        $word = strtolower($word);

        return $word;
    }
}
