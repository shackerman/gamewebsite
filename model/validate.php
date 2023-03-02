<?php

class validate
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
}