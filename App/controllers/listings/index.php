<?php

// Creating config and Database objects
$config = require basePath('configs/db.php');
$db = new Database($config);

// Fetching all the listings
$listings = $db->query('SELECT * FROM listings')->fetchAll();

loadView('listings/index', ['listings' => $listings]);
