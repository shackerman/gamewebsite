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

    function gameList()
    {
        $view = new Template();
        echo $view->render('views/gameList.html');
    }

    function newUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = new User();
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $password = $_POST['password'];
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
            //Redirect to summary page
            if (empty($this->_f3->get('errors'))) {
                $_SESSION['user'] = $user;
                $this->_f3->reroute('logIn');
            }
        }
        $view = new Template();
        echo $view->render('views/newUser.html');
    }

    function logIn()
    {
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