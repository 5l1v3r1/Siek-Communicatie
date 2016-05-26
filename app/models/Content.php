<?php

class Content extends \Phalcon\Mvc\Model
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
    public $text;

    /**
     *
     * @var string
     */
    public $page;

    /**
     *
     * @var string
     */
    public $section;

    /**
     *
     * @var bool
     */
    public $textarea;

    /**
     *
     * @var string
     */
    public $lastUpdated;

    /**
     *
     * @var string
     */
    public $lastUpdatedBy;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource('tblContent');
        $this->belongsTo('lastUpdatedBy', 'tblTeam', 'id');
    }

    /**
     * Find text more neatly
     */
    public static function findText($page, $section) {
        return self::findFirst(array(
            "page = :page: and section = :section:",
            "bind" => [
                'page'    => $page,
                'section' => $section
            ]
        ))->text;
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'text' => 'text', 
            'page' => 'page',
            'section' => 'section',
            'textarea' => 'textarea',
            'lastUpdated' => 'lastUpdated',
            'lastUpdatedBy' => 'lastUpdatedBy'
        );
    }

}
