<?php

/**
 * Namespace
 * @copyright copyright (c) 2014 Paradoxis
 */
namespace Paradoxis\Security;

/**
 * Class Auth
 */
class Auth extends \Phalcon\Mvc\User\Component {

    /**
     * Authenticate a user
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function authenticate($username, $password) {
        if ($user = \Users::findFirst([
            "conditions" => "email = :email: AND password = :password:",
            "bind" => [
                "email" => $username,
                "password" => \Users::hashPass($username, $password)
            ]
        ])) {
            $this->session->set('user', $user);
            return true;
        } else {
            $this->messages[] = "Invalid username or password";
            return false;
        }
    }

    /**
     * Check if a user is authenticated
     * @return bool
     */
    public function isAuthenticated() {
        return $this->session->has('user');
    }

    /**
     * Check if a user is an admin
     * @return bool
     */
    public function isAdmin() {
        return ($this->session->get('user')->admin == 1);
    }

    /**
     * Get messages
     * @return array
     */
    private $messages = [];
    public function getMessages()
    {
        return $this->messages;
    }
}
