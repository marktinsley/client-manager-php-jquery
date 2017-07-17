<?php

namespace Project\Hashing;

class Password
{
    /**
     * Hash a password.
     *
     * @param $value
     *
     * @return string
     */
    public static function hash($value)
    {
        $result = password_hash($value, PASSWORD_BCRYPT);

        if ($result === false) {
            throw new FailedHashingPasswordException('Could not hash the given password.');
        }

        return $result;
    }

    /**
     * Verify that the given plain-text password matches the hashed password.
     *
     * @param $plain
     * @param $hashed
     *
     * @return bool
     */
    public static function verify($plain, $hashed)
    {
        return password_verify($plain, $hashed);
    }
}