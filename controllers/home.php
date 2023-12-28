<?php

// Creating config and Database objects
$config = require basePath('configs/db.php');
$db = new Database($config);

// Fetching the top 6 listings
$listings = $db->query('SELECT * FROM listings LIMIT 6')->fetchAll();

loadView('home');
