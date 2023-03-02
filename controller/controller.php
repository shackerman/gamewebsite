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

    function newUSer()
    {
        $view = new Template();
        echo $view->render('views/newUser.html');
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