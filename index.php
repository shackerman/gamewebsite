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

// Define a default route ("Home page" project)
$f3->route('GET /', function(){
    $GLOBALS['con']->home();
});

$f3->route('GET /homePage', function(){
    $GLOBALS['con']->home();
});

$f3->route('GET /gameList', function(){
    $GLOBALS['con']->gameList();
});

$f3->route('GET /newUser', function(){
    $GLOBALS['con']->newUser();
});

//Run Fat-Free
$f3->run();
//Java -> f3.run();
