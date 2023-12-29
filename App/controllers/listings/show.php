<?php

// Creating config and Database objects
$config = require basePath('configs/db.php');
$db = new Database($config);

// Getting the listing id from the URL
$id = htmlspecialchars($_GET['id']) ?? null;
if (!empty($id)) {
    // Fetching all the listings
    $listing = $db->query('SELECT * FROM listings WHERE id=:id', ['id' => $id])->fetch();

    loadView('listings/show', ['listing' => $listing]);
} else {
    goToPath();
}
