<?php

use System\Application;

if(! function_exists('pre'))
{
    function pre($var)
    {
        echo "<pre>";
        print_r($var);
        echo "</pre>";
    }
}


if(! function_exists('array_get'))
{
    /**
     * Get value from array if exist  Otherwise Get default
     *
     * @param array $array
     * @param string|int  $key
     * @param mixed $default
     * @return bool
     */
    function array_get($array, $key, $default = null){

        return isset($array[$key]) ? $array[$key] : $default;
    }
}

if(! function_exists('_e')) {

    /**
     * Escabe the given value
     * @param string $value
     * @return string
     */
    function _e($value) {
        return htmlspecialchars($value);
    }
}

if(! function_exists('assets')) {

    /**
     * Generate full path fot the given path in public directory
     *
     * @param string $path
     * @return string
     */
    function assets($path) {

        $app = Application::getInstance();

        return $app->url->link('public/' . $path);
    }

}

if(! function_exists('url')) {
    /**
     * Generate full path fot the given path in public directory
     *
     * @param string $path
     * @return string
     */
    function url($path) {

        $app = Application::getInstance();

        return $app->url->link($path);
    }
}

if(! function_exists('read_more')){

    /**
     * Cut the given string with white space
     * @param string $string
     * @param int $number_of_words
     * @return string
     */
    function read_more($string, $number_of_words) {

        // Explode the given string with white space
        $words_of_string = array_filter(explode(' ', $string));


        if(count($words_of_string) <= $number_of_words) {
            return $string;
        }
        // glue the sliced words from string again and return it
        return implode(' ', array_slice($words_of_string, 0, $number_of_words));
    }
}

if(!function_exists('seo')) {

    function seo($string) {

        $string = trim($string);

        $string = preg_replace('#[^\w]#', ' ', $string);

        $string = preg_replace('#[\s]+#', ' ', $string);

        $string = str_replace(' ', '-', $string);

        return trim(strtolower($string), '-');

    }
}