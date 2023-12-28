<?php

require '../helpers.php';
require basePath('Router.php');
require basePath('Database.php');

// Instantiating the router
$router = new Router();

// Get routes
require basePath('routes.php');

// Get current URI and HTTP_METHOD
$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

// Route the request
$router->route($uri, $method);
