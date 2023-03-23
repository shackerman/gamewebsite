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
            //$order = new gameOrder();
            $user = new User();
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $address = $_POST['stAddress'];
            $city = $_POST['city'];
            $zip = $_POST['zip'];
            $state = $_POST['state'];
            $cardNumber = $_POST['cardNumber'];
            $expirationDate = $_POST['expiration'];
            $cvv = $_POST['cvv'];
            $_SESSION['state'] = $state;
            $_SESSION['name'] = $name;
            $_SESSION['account'] = "Log In/Create Account";
            $_SESSION['href'] = "newUser";
            $_SESSION['login'] = "false";
            if (Validate::validName($name)) {
                //$order->setName($name);
                $_SESSION['name'] = $name;
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
                $_SESSION['email'] = $email;
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
                $_SESSION['Address'] = $_SESSION['address'].", ".$_SESSION['city'].", ".$_SESSION['state']." ".$_SESSION['zip'];
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
        if ($_SESSION['name'] == ""){
            $guest_id = uniqid('guest_');
            $_SESSION['name'] = $guest_id;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tittle = $_POST['title'];
            if (empty($this->_f3->get('errors'))) {
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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_SESSION['href'] != "logIn"){
                $gameOrder = new gameOrder();
            } else {
                $gameOrder = new gameOrder_membership();
            }
            $gameOrder->setName($_SESSION['name']);
            $_SESSION['guestName'] = $_SESSION['name'];
            $_SESSION['quantity'] = $_POST['quantity'];
            $gameOrder->setTitle($_SESSION['tittle']);
            if (!$gameOrder instanceof gameOrder_membership){
                $gameOrder->setEmail("Null");
            } else {
                $gameOrder->setEmail($_SESSION['email']);
            }
            if ($_SESSION['tittle'] == 'Fortnite'){
                $gameOrder->setPrice('0');
            } elseif ($_SESSION['tittle'] == 'Pacman'){
                $gameOrder->setPrice('4.44');
            }
            elseif ($_SESSION['tittle'] == 'Call of Duty'){
                $gameOrder->setPrice('19.99');
            }elseif ($_SESSION['tittle'] == 'Super Mario Bros'){
                $gameOrder->setPrice('19.99');
            }elseif ($_SESSION['tittle'] == 'Minecraft'){
                $gameOrder->setPrice('29.99');
            }elseif ($_SESSION['tittle'] == 'Sonic'){
                $gameOrder->setPrice('9.99');
            }
            $gameOrder->setQty($_SESSION['quantity']);

            $_SESSION['discount'] = 0;

            if ($gameOrder instanceof gameOrder_membership){
                $_SESSION['discount'] = 0.1;
                $gameOrder->setDiscount($_SESSION['discount']);
            }
            if (empty($this->_f3->get('errors'))) {
                $gameOrder->setAddress($_SESSION['Address']);
                $_SESSION['gameOrder'] = $gameOrder;
                $id = $GLOBALS['dataLayer']->insertCart($_SESSION['gameOrder']);
                //$this->_f3->reroute('cart');
            }
        }
        $view = new Template();
        echo $view->render('views/product_pages.html');
    }
    function cart()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $name2 = $_POST['guestName'];
            $email2 = $_POST['guestEmail'];
            $address2 = $_POST['guestStAddress'];
            $city2 = $_POST['guestCity'];
            $zip2 = $_POST['guestZip'];
            $state2 = $_POST['guestState'];
            $_SESSION['state2'] = $state2;
            $cardNumber2 = $_POST['guestCardNumber'];
            $expirationDate2 = $_POST['guestExpiration'];
            $cvv2 = $_POST['guestCvv'];
            $_SESSION['day'] = $_POST['day'];
            $_SESSION['gameOrder']->setShipping($_SESSION['day']);
            if (Validate::validName($name2)) {
                //$order->setName($name);
                $_SESSION['gameOrder']->setName($name2);
            }
            else {
                $this->_f3->set('errors["guestName"]',
                    'Please re-enter a valid name!');
            }

            if (Validate::validEmail($email2)) {
                $_SESSION['gameOrder']->setEmail($email2);
            }
            else {
                $this->_f3->set('errors["guestEmail"]',
                    'Please re-enter a valid email!');
            }

            if (Validate::validStAddress($address2)) {
                $_SESSION['address2'] = $address2;
            }
            else {
                $this->_f3->set('errors["guestStAddress"]',
                    'Please enter valid address!');
            }


            if (Validate::validCity($city2)) {
                $_SESSION['city2'] = $city2;
            }
            else {
                $this->_f3->set('errors["guestCity"]',
                    'Please enter valid city!');
            }

            if (Validate::validZipcode($zip2)) {
                $_SESSION['zip2'] = $zip2;
            }
            else {
                $this->_f3->set('errors["guestZip"]',
                    'Please enter valid Zipcode!');
            }
            $_SESSION['Address2'] = $_SESSION['address2'].", ".$_SESSION['city2'].", ".$_SESSION['state2']." ".$_SESSION['zip2'];
            if ($_SESSION['gameOrder'] instanceof gameOrder_membership){
                $_SESSION['gameOrder']->setAddress($_SESSION['Address']);
            } else {
                $_SESSION['gameOrder']->setAddress($_SESSION['Address2']);
            }


            if (Validate::validCardNumber($cardNumber2)) {
                $_SESSION['cardNumber'] = $cardNumber2;
            }
            else {
                $this->_f3->set('errors["guestCardNumber"]',
                    'Please enter valid card number!');
            }

            if (Validate::validExpiration($expirationDate2)) {
                $_SESSION['expiration'] = $expirationDate2;
            }
            else {
                $this->_f3->set('errors["guestExpiration"]',
                    'Please enter valid expiration date!');
            }

            if (Validate::validCVV($cvv2)) {
                $_SESSION['cvv'] = $cvv2;
            }
            else {
                $this->_f3->set('errors["guestCvv"]',
                    'Please enter valid card security cvv!');
            }
            if ($_SESSION['gameOrder'] instanceof gameOrder_membership){
                $this->_f3->reroute('orderPlaced');
            }
            if (empty($this->_f3->get('errors'))) {
                $this->_f3->reroute('orderPlaced');
            }
        }
        $name = $_SESSION['name'];
        //Get the data from the model
        $customerCart = $GLOBALS['dataLayer']->getCart($name);
        $this->_f3->set('customerCarts', $customerCart);

        $totalPrice = $GLOBALS['dataLayer']->getPrice($name);
        $this->_f3->set('totals', $totalPrice);

        $this->_f3->set('Shippings', DataLayer::getShipping());


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
    function orderPlaced()
    {
        $id = $GLOBALS['dataLayer']->insertOrder($_SESSION['gameOrder']);
        echo "Order ID: ".$id;
        var_dump($_SESSION['guestName']);
        $deleteCart = $GLOBALS['dataLayer']->deleteCart($_SESSION['guestName']);
        $deleteMemberCart = $GLOBALS['dataLayer']->deleteCart($_SESSION['Name']);
        $this->_f3->set('deleteCarts', $deleteCart);
        $this->_f3->set('deleteMemberCarts', $deleteMemberCart);


        $view = new Template();
        echo $view->render('views/orderPlaced.html');
    }

    function logIn()
    {
        $_SESSION['href'] = "false";
        $_SESSION['account'] = "Log In/Create Account";
        session_destroy();
        $view = new Template();
        echo $view->render('views/logIn.html');
        $guest_id = uniqid('guest_');
        $_SESSION['name'] = $guest_id;
        $_SESSION['guestName'] = $guest_id;
    }

    function admin()
    {
        //Instantiate a view
        $view = new Template();
        echo $view->render("views/admin.html");
    }
    
}
