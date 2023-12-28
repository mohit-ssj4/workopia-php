<?php

require '../helpers.php';
require basePath('Router.php');
require basePath('Database.php');

$config = require basePath('configs/db.php');
$db = new Database($config);

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$router = new Router();
require basePath('routes.php');
$router->route($uri, $method);
