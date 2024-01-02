<?php

require __DIR__ . '/../vendor/autoload.php';

use Framework\Router;
use Framework\Session;

// Start the session
Session::start();

require '../helpers.php';

// Instantiating the router
$router = new Router();

// Get routes
require basePath('routes.php');

// Get current URI and HTTP_METHOD
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Route the request
$router->route($uri);
