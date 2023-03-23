<?php

//This is my CONTROLLER

//Turn on error reporting

ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require_once('vendor/autoload.php');

//start session
session_start();

// Create an instance of the Base class
$f3 = Base::instance();
//Java equivalent -> Base f3 = new Base();

//Instantiate a Controller object
$con = new Controller($f3);
$dataLayer = new DataLayer();

// Define a default route ("Home page" project)
$f3->route('GET /', function(){
    $GLOBALS['con']->home();
});
$f3->route('GET /home2', function(){
    $GLOBALS['con']->home2();
});

$f3->route('GET /homePage', function(){
    $GLOBALS['con']->home();
});

$f3->route('GET|POST /gameList', function(){
    $GLOBALS['con']->gameList();
});

$f3->route('GET|POST /productPage', function(){
    $GLOBALS['con']->productPage();
});
$f3->route('GET|POST /cart', function(){
    $GLOBALS['con']->cart();
});


$f3->route('GET|POST /newUser', function(){
    $GLOBALS['con']->newUser();
});

$f3->route('GET /logIn', function(){
    $GLOBALS['con']->logIn();
});
$f3->route('GET /orderPlaced', function(){
    $GLOBALS['con']->orderPlaced();
});

//Run Fat-Free
$f3->run();
//Java -> f3.run();
