<?php

class References extends \Phalcon\Mvc\Model
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
    public $quote;

    /**
     *
     * @var string
     */
    public $author;

    /**
     *
     * @var string
     */
    public $source;

    /**
     *
     * @var string
     */
    public $date;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource('tblReferences');
    }

    /**
     * After fetch for dates
     */
    public function afterFetch()
    {
        if ($this->date) $this->date = date('d-m-Y', strtotime($this->date));

    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'quote' => 'quote', 
            'author' => 'author', 
            'source' => 'source', 
            'date' => 'date'
        );
    }

}
