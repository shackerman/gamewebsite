<?php

/**
 * This class holds and manages the data that the customer enters when creating their account and making their order 
 * and matches it with global variables on the rest of the site.
 *
 * @category   Classes
 * @package    Classes
 * @author     Jeconiah Alferez-Ruiz
 * @author     Ron Nguyen
 * @author     Jerome Shadkim
 * @copyright  1997-2005 The PHP Group
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: @1.00@
 * @link       https://nguyenron.greenriverdev.com/328/gamewebsite/homePage
 * @see        gameOrder
 * @since      Class available since Release 1.2.0
 * @deprecated Class not deprecated yet.
 */

class gameOrder
{
    private $_name;
    private $_title;
    private $_price;
    private $_qty;
    private $_email;
    private $_shipping;
    private $_address;

    function __construct($name="",  $_email= "", $title="", $price="", $qty="", $shipping = "", $address ="")
    {
        $this->_name = $name;
        $this->_email = $_email;
        $this->_title = $title;
        $this->_price = $price;
        $this->_qty= $qty;
        $this->_shipping = $shipping;
        $this->_address = $address;
    }

    /**
     * getLname returns the last name in the application
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * setLname sets last name in the application
     * @param string
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * getFname returns the first name in the application
     * @return string
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * setFname sets first name in the application
     * @param string $fname
     */
    public function setTitle($title)
    {
        $this->_title = $title;
    }

    /**
     * getEmail returns the email in the application
     * @return string
     */
    public function getPrice()
    {
        return $this->_price;
    }

    /**
     * setEmail sets email in the application
     * @param string $email
     */
    public function setPrice($price)
    {
        $this->_price = $price;
    }

    /**
     * getState returns the state in the application
     * @return string
     */
    public function getQty()
    {
        return $this->_qty;
    }

    /**
     * setState sets a state in the application
     * @param string $state
     */
    public function setQty($qty)
    {
        $this->_qty = $qty;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return string
     */
    public function getShipping()
    {
        return $this->_shipping;
    }

    /**
     * @param string $shipping
     */
    public function setShipping($shipping)
    {
        $this->_shipping = $shipping;
    }

    /**
     * @return mixed|string
     */
    public function getAddress()
    {
        return $this->_address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->_address = $address;
    }


}
