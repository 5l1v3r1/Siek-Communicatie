<?php

use Phalcon\Mvc\Model\Validator\PresenceOf as PresenceOf;

class Blog extends \Phalcon\Mvc\Model
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
    public $title;

    /**
     *
     * @var string
     */
    public $text;

    /**
     *
     * @var integer
     */
    public $author;

    /**
     *
     * @var string
     */
    public $date;

    /**
     *
     * @var string
     */
    public $lastUpdated;

    /**
     *
     * @var integer
     */
    public $lastUpdatedBy;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource('tblBlog');
    }

    /**
     * Before save
     */
    public function beforeValidation()
    {
        $this->url = preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $this->url)));
        $this->lastUpdated = date("Y-m-d h:i:s");
    }

    /**
     * Validations and business logic
     */
    public function validation()
    {
        $this->validate(
            new PresenceOf(
                array(
                    'field' => 'url',
                    'required' => true
                )
            )
        );

        $this->validate(
            new PresenceOf(
                array(
                    'field' => 'title',
                    'required' => true
                )
            )
        );

        $this->validate(
            new PresenceOf(
                array(
                    'field' => 'text',
                    'required' => true
                )
            )
        );

        $this->validate(
            new PresenceOf(
                array(
                    'field' => 'author',
                    'required' => true
                )
            )
        );

        if ($this->validationHasFailed() == true) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Convert values after fetch
     */
    public function afterFetch()
    {
        $this->date = date('d-m-Y', strtotime($this->date));
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'url' => 'url', 
            'title' => 'title', 
            'text' => 'text', 
            'author' => 'author', 
            'date' => 'date', 
            'lastUpdated' => 'lastUpdated', 
            'lastUpdatedBy' => 'lastUpdatedBy'
        );
    }

}
