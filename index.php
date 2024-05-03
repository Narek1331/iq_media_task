<?php

// Include necessary files
require_once 'router.php'; 
require_once 'controllers/HomeController.php'; 
require_once 'controllers/AuthController.php'; 
require_once 'controllers/ProfileController.php'; 
require_once 'controllers/URLShortenerController.php'; 

// Start session
session_start();


$router = new Router();

// Define routes
$router->addRoute('GET', '~^/$~', 'HomeController@index');

$router->addRoute('GET', '~^/login$~', 'AuthController@login');
$router->addRoute('GET', '~^/register$~', 'AuthController@register');

$router->addRoute('GET', '~^/profile$~', 'ProfileController@index');


$router->addRoute('POST', '~^/signin$~', 'AuthController@signin');
$router->addRoute('POST', '~^/signup$~', 'AuthController@signup');

$router->addRoute('POST', '~^/store_url_shortener$~', 'URLShortenerController@store');



// Example usage
$router->handleRequest($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

?>
