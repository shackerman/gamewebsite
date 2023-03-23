<?php

/**
 * This class holds onto the bonuses that members get, in this case a discount.
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
 * @see        gameOrder_membership
 * @since      Class available since Release 1.2.0
 * @deprecated Class not deprecated yet.
 */

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