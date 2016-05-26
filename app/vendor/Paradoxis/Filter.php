<?php

/**
 * Namespace
 * @copyright copyright (c) 2014 Paradoxis
 */
namespace Paradoxis;

/**
 * Class Filter
 * Volt filter functions, string modifiers, helpers, etc
 * @package Paradoxis
 */
class Filter {

    /**
     * Allow users to easily add styles
     * @param string $string
     * @return string
     */
    public static function style($string) {

        /**
         * Styles with their HTML equivalents
         */
        $bullet = "•\t";
        $break  = "<br />";
        $styles = array(

            /* Bold, italic, underline */
            "{{" => "<i>",
            "}}" => "</i>",
            "((" => "<b>",
            "))" => "</b>",
            "[[" => "<u>",
            "]]" => "</u>",

            /* Headings */
            "#[" => "<h2>",
            "]#" => "</h2>"
        );

        /**
         * Loop through the basic styles and apply them to the string
         */
        foreach($styles as $character => $tag) {
            $string = str_replace($character, $tag, $string);
        }

        /**
         * Replace all bullet points
         */
        while (strpos($string, $bullet)) {
            $start  = strpos($string, $bullet);
            $end    = strpos(substr($string, $start), $break);
            $item   = substr($string, $start, $end);
            $item   = str_replace($bullet, '<span class="li">', $item) . "</span>";
            $string = substr_replace($string, $item, $start, $end);
        }

        /**
         * Return the formatted string
         */
        return $string;
    }

    /**
     * Limit a string
     * @param string $string
     * @param int $length
     * @return string
     */
    public static function limit($string, $length) {
        return strip_tags(substr($string, 0, $length - 2).'..', '<br />');
    }
}