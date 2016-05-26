<?php

/**
 * Namespace
 * @copyright copyright (c) 2014 - 2015 Paradoxis
 */
namespace Paradoxis\MVC;

/**
 * Class URL
 * @package Paradoxis\MVC
 */
class URL {

    /**
     * @param $prefix
     * @param int $page
     * @return array
     */
    public static function getBlogPageNavigation($prefix, $page = 0, $default = null)
    {
        /**
         * Initialize navigation
         * @var array
         */
        $navigation = [];

        /**
         * Add previous button
         */
        if ($page > 0) {
            $navigation[] = (object) [
                'title' => 'Vorige',
                'url' => ((($page - 1) <= 0 && $default) ? $default : $prefix.($page - 1))
            ];
        } else {
            $navigation[] = (object) [
                'title' => '',
                'url' => ''
            ];
        }

        /**
         * Add next button
         */
        $navigation[] = (object) [
            'title' => 'Volgende',
            'url'   => $prefix.($page + 1)
        ];


        return $navigation;
    }
}