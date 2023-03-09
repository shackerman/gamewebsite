<?php

class Validate
{
//return true if user has at least two characters
    static function validUser($user)
    {
        if (strlen($user) > 2) {
            return false;
        } else {
            return true;
        }

        return strlen($user) > 2;
    }

    static function validName($name)
    {
        //check if not string or empty string
        if (!is_string($name) || strlen($name) == 0) {
            return false;
        }

        // check contain only alphabetic characters
        if (preg_match('/^[a-zA-Z]+$/', $name) == 0) {
            return false;
        }

        return true;
    }

    static function validPhone($phone)
    {
        if (!is_numeric($phone) || strlen($phone) == 0 || strlen($phone) != 10) {
            return false;
        }
        return true;
    }

    static function validEmail($email)
    {
        //check if empty, an email could contain numeric
        if (strlen($email) == 0) {
            return false;
        }

        // check a valid email address
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }

    static function validPassword($password){
        if (strlen($password) < 8) {
            return false;
        }

        // Password must contain at least one uppercase letter.
        if (!preg_match('/[A-Z]/', $password)) {
            return false;
        }

        // Password must contain at least one lowercase letter.
        if (!preg_match('/[a-z]/', $password)) {
            return false;
        }

        // Password must contain at least one number.
        if (!preg_match('/[0-9]/', $password)) {
            return false;
        }

        // Password is valid.
        return true;
    }
}