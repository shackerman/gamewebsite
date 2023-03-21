<?php

class Order
{
    private $_title;
    private $_price;
    private $_qty;

    /**
     * parameterized contructer that take in tittle price and quantity of the game
     * that user wanted to buy
     * @param $title
     * @param $price
     * @param $qty
     */
    function __construct( $title="", $price="", $qty="")
    {
        $this->_title = $title;
        $this->_price = $price;
        $this->_qty = $qty;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->_title = $title;
    }

    /**
     * @return string
     */
    public function getPrice()
    {
        return $this->_price;
    }

    /**
     * @param string $price
     */
    public function setPrice($price)
    {
        $this->_price = $price;
    }

    /**
     * @return string
     */
    public function getQty()
    {
        return $this->_qty;
    }

    /**
     * @param string $qty
     */
    public function setQty($qty)
    {
        $this->_qty = $qty;
    }


}