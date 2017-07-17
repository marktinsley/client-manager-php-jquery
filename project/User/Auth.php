<?php

namespace Project\User;

use Project\Databases\Connection;
use Project\Hashing\Password;
use Project\Session;

class Auth
{
    public function __construct()
    {
        $this->session = Session::getInstance();
    }

    /**
     * Is a user currently logged in?
     *
     * @return bool
     */
    public function isLoggedIn()
    {
        return (bool)$this->session->get('auth_id');
    }

    /**
     * Invalidate the currently logged in user.
     */
    public function invalidate()
    {
        $this->session->set('auth_id', null);
    }

    /**
     * Attempt to verify a user's credentials.
     *
     * @param $username
     * @param $password
     *
     * @return bool
     */
    public function attempt($username, $password)
    {
        list($id, $actualPassword) = $this->getInfoFor($username);

        if ( ! $id || ! Password::verify($password, $actualPassword)) {
            return false;
        }

        $this->session->set('auth_id', (int)$id);

        return true;
    }

    /**
     * Gives you the account password for a given username.
     *
     * @param $username
     *
     * @return mixed
     */
    protected function getInfoFor($username)
    {
        $result = Connection::getInstance()->getRow(
            'SELECT id, password FROM users WHERE username = ?', [$username]
        );

        return $result ?: [null, null];
    }
}