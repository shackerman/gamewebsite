<?php

require_once ($_SERVER['DOCUMENT_ROOT'].'/../pdo-config.php');

/**
 * This class holds and manages the data that customers add to the database, such as the orders, their cart.
 * It also hosts some of our data such as what game titles they purchase and the shipment option they choose.
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
 * @see        DataLayer
 * @since      Class available since Release 1.2.0
 * @deprecated Class not deprecated yet.
 */

class DataLayer{
    // Database connection object
    private $_dbh;

    //instantiate constructor
    function __construct()
    {
        try {
            //Instantiate a PDO object
            $this->_dbh = new PDO(DB_DRIVER, USERNAME, PASSWORD);
            //echo 'Successful!';
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    //add applicant to database
    function insertCart($order)
    {
        //1. Define the query
        $sql = "INSERT INTO cart (name, email, title, price, qty, discount)
                        VALUES
                        (:name, :email, :title, :price, :qty, :discount)";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters
        $name = $order->getName();
        $email = $order->getEmail();
        $tittle = $order->getTitle();
        $price = $order->getPrice();
        $qty = $order->getQty();
//        $shipping = $order->getShipping();
        $discount = 0;
        if ($order instanceof gameOrder_membership){
            $discount = 0.1;
            $shipping = 0;
        }

        $statement->bindParam(':name', $name);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':title', $tittle);
        $statement->bindParam(':price', $price);
        $statement->bindParam(':qty', $qty);
//        $statement->bindParam(':shipping', $shipping);
        $statement->bindParam(':discount', $discount);

        //4. Execute the query
        $statement->execute();
        //var_dump($statement->errorInfo());

        //5. Process the results
        $id = $this->_dbh->lastInsertId();
        return $id;
    }

    function insertOrder($order)
    {
        //1. Define the query
        $sql = "INSERT INTO gameOrder (name, email, title, price, qty, shipping, address)
                        VALUES
                        (:name, :email, :title, :price, :qty, :shipping, :address)";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters
        $name = $order->getName();
        $email = $order->getEmail();
        $tittle = $order->getTitle();
        $price = $order->getPrice();
        $qty = $order->getQty();
        $shipping = $order->getShipping();
        $address = $order->getAddress();
        if ($order instanceof gameOrder_membership){
            $shipping = "Free One Day Shipping";
        }

        $statement->bindParam(':name', $name);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':title', $tittle);
        $statement->bindParam(':price', $price);
        $statement->bindParam(':qty', $qty);
        $statement->bindParam(':shipping', $shipping);
        $statement->bindParam(':address', $address);

        //4. Execute the query
        $statement->execute();
        //var_dump($statement->errorInfo());

        //5. Process the results
        $id = $this->_dbh->lastInsertId();
        return $id;
    }

    function getCart($name)
    {
        //1. Define the query
        $sql = "SELECT * FROM cart WHERE name = '$name'";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters

        //4. Execute the query
        $statement->execute();

        //5. Process the results
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    function getOrder()
    {
        //1. Define the query
        $sql = "SELECT * FROM gameOrder";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters

        //4. Execute the query
        $statement->execute();

        //5. Process the results
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function deleteCart($name)
    {
        //1. Define the query
        $sql = "DELETE FROM cart WHERE name = '$name'";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters

        //4. Execute the query
        $statement->execute();

        //5. Process the results
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function getPrice($name)
    {
        //1. Define the query
        $sql = "SELECT SUM(price * qty) AS total_price FROM cart WHERE name = '$name'";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters

        //4. Execute the query
        $statement->execute();

        // 4. Retrieve the result
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $price = $row['price'];

        // 5. Calculate the total price
        return $row['total_price'];
    }

    static function getTittle()
    {
        return array("Fortnite", "Pacman", "Call of Duty", "Super Mario Bros", "Minecraft", "Sonic");
    }

    static function getShipping(){
        return array("5.99","3.99","0");
    }
}
