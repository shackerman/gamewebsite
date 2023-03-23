<?php

/**
 * This class holds and manages the data that customers add to the database when they create their account, as well as validate that information.
 * It accomplishes this using a mix of PHP and Regex validation.
 *
 * @category   Model
 * @package    Model
 * @author     Jeconiah Alferez-Ruiz
 * @author     Ron Nguyen
 * @author     Jerome Shadkim
 * @copyright  1997-2005 The PHP Group
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: @1.00@
 * @link       https://nguyenron.greenriverdev.com/328/gamewebsite/homePage
 * @see        Validate
 * @since      Class available since Release 1.2.0
 * @deprecated Class not deprecated yet.
 */

class Validate
{
    /**
     * This function validate name from user input
     * @param $name
     * @return bool
     */
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

    /**
     * This function valid phone numbers from user input
     * @param $phone
     * @return bool
     */
    static function validPhone($phone)
    {
        // if not number, empty and length of 10 return false
        if (!is_numeric($phone) || strlen($phone) == 0 || strlen($phone) != 10) {
            return false;
        }
        return true;
    }

    /**
     * This function validates if the user enter a valid email or not
     * @param $email
     * @return bool
     */
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

    /**
     * This function will take password from user input then check if is
     * a good password
     * @param $password
     * @return bool
     */
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

    /**
     * This function will valid the street address
     * @param $address
     * @return bool
     */
    static function validStAddress($address)
    {
        $pattern = "/^\d+\s[A-z]+\s[A-z]+/";
        if (preg_match($pattern, $address)) {
            return true; // address is valid
        } else {
            return false; // address is invalid
        }
    }

    /**
     * This function validate city
     * @param $city
     * @return bool
     */
    static function validCity($city) {
        $pattern = "/^[a-zA-Z]+(?:[\s-][a-zA-Z]+)*$/";
        //if len of city is empty return false
        if (strlen($city) == 0){
            return false;
        }
        if (preg_match($pattern, $city)) {
            return true; // city is valid
        } else {
            return false; // city is invalid
        }
    }

    /**
     * this function validate zipcode take in only 5 numbers
     * @param $zip
     * @return bool
     */
    static function validZipcode($zip) {
        $pattern = "/^\d{5}(?:[-\s]\d{4})?$/";
        //if len of zip not euqal 5 or empty return false
        if (strlen($zip) != 5 || strlen($zip) == 0){
            return false;
        }
        if (preg_match($pattern, $zip)) {
            return true; // ZIP code is valid
        } else {
            return false; // ZIP code is invalid
        }
    }

    /**
     * this function validate card number that user enter
     * @param $cardNumber
     * @return false|void
     */
    static function validCardNumber($cardNumber){
        // Strip any non-digits from the card number
        $cardNumber = preg_replace("/[^0-9]/", "", $cardNumber);

        // Check that the card number is a valid length
        $cardLength = strlen($cardNumber);
        if ($cardLength < 13 || $cardLength > 19) {
            return false;
        }

        return true;
    }

    /**
     * This function validate input is only number allow
     * and check year is not in the past
     * @param $expiration
     * @return bool
     */
    static function validExpiration($expiration){
        list($monthInput, $yearInput) = explode('/', $expiration);
        $month = $monthInput;
        $year = $yearInput;

        // Extract the month and year from the expiration date
//        $month = intval($matches[1]);
//        $year = intval($matches[2]);

        // Check that the year is not in the past
        $currentYear = intval(date("y"));
        $currentMonth = intval(date("m"));
        if ($year < $currentYear || ($year == $currentYear && $month < $currentMonth)) {
            return false;
        }

        // Expiration date is valid
        return true;
    }

    /**
     * This function will check cvv is take in 3 or 4 number from
     * user input
     * @param $cvv
     * @return bool
     */
    static function validCVV($cvv){
        // Check that the CVV code is a 3- or 4-digit number
        if (!preg_match("/^[0-9]{3,4}$/", $cvv)) {
            return false;
        }

        // CVV code is valid
        return true;
    }
}