<?php
class gameOrder_membership extends gameOrder
{
    private $_discount;

    public function __construct($discount = "")
    {
        $this->_discount = $discount;
    }

    /**
     * @return
     */
    public function getDiscount()
    {
        return $this->_discount;
    }

    /**
     * @param $discount
     */
    public function setDiscount($discount)
    {
        $this->_discount = $discount;
    }
}