<?php

// 328/gamewebsite/controller/controller.php

class Controller
{
    private $_f3; //Fat-Free object

    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    function home()
    {
        //Instantiate a view
        $view = new Template();
        echo $view->render("views/home.html");

    }


    function newUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = new User();
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $address = $_POST['stAddress'];
            $city = $_POST['city'];
            $zip = $_POST['zip'];
            $cardNumber = $_POST['cardNumber'];
            $expirationDate = $_POST['expiration'];
            $cvv = $_POST['cvv'];
            $_SESSION['name'] = $name;
            $_SESSION['account'] = "Log In/Create Account";
            $_SESSION['href'] = "newUser";
            $_SESSION['login'] = "false";
            if (Validate::validName($name)) {
                $user->setName($name);
            }
            else {
                $this->_f3->set('errors["name"]',
                    'Please re-enter a valid name!');
            }

            if (Validate::validPhone($phone)) {
                $user->setPhone($phone);
            }
            else {
                $this->_f3->set('errors["phone"]',
                    'Please re-enter a valid phone number!');
            }

            if (Validate::validEmail($email)) {
                $user->setEmail($email);
            }
            else {
                $this->_f3->set('errors["email"]',
                    'Please re-enter a valid email!');
            }
            if (Validate::validPassword($password)) {
                $user->setPhone($password);
            }
            else {
                $this->_f3->set('errors["password"]',
                    'Password must contain at lease 8 characters, one uppercase letter, one lowercase letter, and one number');
            }

            if (Validate::validStAddress($address)) {
                $_SESSION['address'] = $address;
            }
            else {
                $this->_f3->set('errors["stAddress"]',
                    'Please enter valid address!');
            }


            if (Validate::validCity($city)) {
                $_SESSION['city'] = $city;
            }
            else {
                $this->_f3->set('errors["city"]',
                    'Please enter valid city!');
            }

            if (Validate::validZipcode($zip)) {
                $_SESSION['zip'] = $zip;
            }
            else {
                $this->_f3->set('errors["zip"]',
                    'Please enter valid Zipcode!');
            }

            if (Validate::validCardNumber($cardNumber)) {
                $_SESSION['cardNumber'] = $cardNumber;
            }
            else {
                $this->_f3->set('errors["cardNumber"]',
                    'Please enter valid card number!');
            }

            if (Validate::validExpiration($expirationDate)) {
                $_SESSION['expiration'] = $expirationDate;
            }
            else {
                $this->_f3->set('errors["expiration"]',
                    'Please enter valid expiration date!');
            }

            if (Validate::validCVV($cvv)) {
                $_SESSION['cvv'] = $cvv;
            }
            else {
                $this->_f3->set('errors["cvv"]',
                    'Please enter valid card security cvv!');
            }
            //Redirect to summary page
            if (empty($this->_f3->get('errors'))) {
                $_SESSION['user'] = $user;
                $this->_f3->reroute('home2');
                $_SESSION['account'] = "Hi, ".$name;
                $_SESSION['href'] = "logIn";
                $_SESSION['login'] = "true";
            }
        }

        $view = new Template();
        echo $view->render('views/newUser.html');
    }

    function gameList()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//            $order = new Order();
            $tittle = $_POST['title'];
//            $order->setTitle($tittle);
            if (empty($this->_f3->get('errors'))) {
//                $_SESSION['order'] = $order;
                $_SESSION['tittle'] = $tittle;
                $this->_f3->reroute('productPage');
            }
        }
        //add data to f3 hives
        $this->_f3->set('gameTittles', DataLayer::getTittle());
        //retrieve to the page
        $view = new Template();
        echo $view->render('views/gameList.html');
    }

    function productPage(){
        $order = new Order();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_SESSION['quantity'] = $_POST['quantity'];
            if ($_SESSION['tittle'] == 'Fortnite'){
                $order->setTitle($_SESSION['tittle']);
                $order->setPrice(0);
//                $order->setQty($_SESSION['quantity']);
            } elseif ($_SESSION['tittle'] == 'Pacman'){
                $order->setTitle($_SESSION['tittle']);
                $order->setPrice(4.44);
//                $order->setQty($_SESSION['quantity']);
            }
            elseif ($_SESSION['tittle'] == 'Call of Duty'){
                $order->setTitle($_SESSION['tittle']);
                $order->setPrice(19.99);
//                $order->setQty($_SESSION['quantity']);
            }elseif ($_SESSION['tittle'] == 'Super Mario Bros'){
                $order->setTitle($_SESSION['tittle']);
                $order->setPrice(19.99);
//                $order->setQty($_SESSION['quantity']);
            }elseif ($_SESSION['tittle'] == 'Minecraft'){
                $order->setTitle($_SESSION['tittle']);
                $order->setPrice(29.99);
//                $order->setQty($_SESSION['quantity']);
            }elseif ($_SESSION['tittle'] == 'Sonic'){
                $order->setTitle($_SESSION['tittle']);
                $order->setPrice(9.99);
//                $order->setQty($_SESSION['quantity']);
            }
            $order->setQty($_SESSION['quantity']);
            if (empty($this->_f3->get('errors'))) {
                $_SESSION['order'] = $order;
                $this->_f3->reroute('cart');
            }
        }

        $view = new Template();
        echo $view->render('views/product_pages.html');
    }
    function cart()
    {
        $view = new Template();
        echo $view->render('views/cart.html');
    }
    function home2()
    {
        $_SESSION['account'] = "Hi, ".$_SESSION['name'];
        $_SESSION['href'] = "logIn";
        $view = new Template();
        echo $view->render('views/homeSignedIn.html');
    }

    function logIn()
    {
        $_SESSION['href'] = "false";
        $_SESSION['account'] = "Log In/Create Account";
        $view = new Template();
        echo $view->render('views/logIn.html');
    }
//

//    function summary()
//    {
//        //Write to Database
//
//        //Instantiate a view
//        $view = new Template();
//        echo $view->render("views/order-summary.html");
//
//        //Destroy session array
//        session_destroy();
//    }
}