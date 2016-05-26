<?php

use Phalcon\Mvc\Model\Validator\Email as Email;

class Users extends \Phalcon\Mvc\Model
{

    /**
     * Column ID
     * @var integer
     */
    public $id;

    /**
     * Username (used as author)
     * @var string
     */
    public $name;

    /**
     * User administrator or simply a blogger?
     * @var bool
     */
    public $admin;

    /**
     * User email
     * @var string
     */
    public $email;

    /**
     * User password
     * Format: sha256(password.sha256(username));
     * @var string
     */
    public $password;

    /**
     * Hash a password
     * @param $username
     * @param $password
     * @return string
     */
    public static function hashPass($username, $password)
    {
        return hash('sha256', $password.hash('sha256', $username));
    }

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
        $this->setSource('tblUsers');
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'name' => 'name', 
            'admin' => 'admin', 
            'email' => 'email', 
            'password' => 'password'
        );
    }

}
