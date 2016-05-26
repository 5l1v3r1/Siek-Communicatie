<?php

use Phalcon\Mvc\Model\Validator\Email as Email;
use Phalcon\Mvc\Model\Validator\PresenceOf as PresenceOf;

class Contact extends \Phalcon\Mvc\Model
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
    public $ip;

    /**
     *
     * @var string
     */
    public $time;

    /**
     *
     * @var string
     */
    public $email;

    /**
     *
     * @var string
     */
    public $subject;

    /**
     *
     * @var string
     */
    public $message;

    /**
     * Validations and business logic
     */
    public function validation()
    {

        $this->validate(
            new Email(
                array(
                    'field'    => 'email',
                    'required' => true,
                )
            )
        );

        $this->validate(
            new PresenceOf(
                array(
                    'field' => 'subject',
                    'required' => true
                )
            )
        );

        $this->validate(
            new PresenceOf(
                array(
                    'field' => 'message',
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
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource('tblContact');
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'ip' => 'ip', 
            'time' => 'time', 
            'email' => 'email', 
            'subject' => 'subject', 
            'message' => 'message'
        );
    }

}
