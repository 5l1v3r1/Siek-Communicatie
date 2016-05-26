<?php

class Team extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $url;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $title;

    /**
     *
     * @var string
     */
    public $text;

    /**
     *
     * @var string
     */
    public $image;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource('tblTeam');
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'url' => 'url', 
            'name' => 'name', 
            'title' => 'title', 
            'text' => 'text', 
            'image' => 'image'
        );
    }

}
