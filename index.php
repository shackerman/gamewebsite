<?php

//This is my CONTROLLER

//Turn on error reporting

ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require_once('vendor/autoload.php');

// Create an instance of the Base class
$f3 = Base::instance();
//Java equivalent -> Base f3 = new Base();

// Define a default route ("Home page" project)
$f3->route('GET /', function(){
    //echo '<h1>Hello, Fat Free!</h1>';
    $view = new Template();
    echo $view->render('views/home.html');
});

$f3->route('GET /homePage', function(){
    //echo '<h1>application, Fat Free!</h1>';
    $view = new Template();
    echo $view->render('views/home.html');
});

$f3->route('GET /gameList', function(){
    //echo '<h1>application, Fat Free!</h1>';
    $view = new Template();
    echo $view->render('views/gameList.html');
});

//Run Fat-Free
$f3->run();
//Java -> f3.run();
