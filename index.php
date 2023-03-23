<?php

/**
 * This class holds and manages the data that customers add to the database when they create their account, as well as validate that information.
 * It accomplishes this using a mix of PHP and Regex validation.
 *
 * @category   Index
 * @package    Index
 * @author     Jeconiah Alferez-Ruiz
 * @author     Ron Nguyen
 * @author     Jerome Shadkim
 * @copyright  1997-2005 The PHP Group
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: @1.00@
 * @link       https://nguyenron.greenriverdev.com/328/gamewebsite/homePage
 * @see        Base::Instance()
 * @since      Class available since Release 1.2.0
 * @deprecated Class not deprecated yet.
 */

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

$f3->route('GET /admin', function () {

    $GLOBALS['con']->admin();

});

//Run Fat-Free
$f3->run();
//Java -> f3.run();
