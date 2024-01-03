<?php

namespace App\Controllers;

use Framework\Database;
use Exception;

class HomeController
{
    protected Database $db;

    /**
     * HomeController class constructor
     *
     * @throws Exception
     */
    public function __construct()
    {
        // Creating config and Database objects
        $config = require basePath('configs/db.php');
        $this->db = new Database($config);
    }

    /**
     * Fetches listings from the DB and loads the home view
     *
     * @return void
     * @throws Exception
     */
    public function index(): void
    {
        // Fetching the top 6 listings
        $listings = $this->db->query('SELECT * FROM listings ORDER BY created_at DESC LIMIT 6')->fetchAll();
        loadView('home', ['listings' => $listings]);
    }
}
