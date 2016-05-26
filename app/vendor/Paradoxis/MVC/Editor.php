<?php

/**
 * Namespace
 * @copyright copyright (c) 2014 - 2015 Paradoxis
 */
namespace Paradoxis\MVC;

/**
 * Class Editor
 * @package Paradoxis\MVC
 */
class Editor {

    /**
     * Elements
     * @var bool
     */
    public $textarea = true;
    public $title = true;

    /**
     * Get the properties
     * @return object
     */
    public function getProperties() {
        return ((object) [
            'elements' => (object) [
                'textarea' => $this->textarea,
                'title' => $this->title
            ]
        ]);
    }
}