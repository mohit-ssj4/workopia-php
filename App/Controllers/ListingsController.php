<?php

namespace App\Controllers;

use Framework\Database;
use Exception;

class ListingsController
{
    protected Database $db;

    /**
     * ListingsController class constructor
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
     * Fetches listings from the DB and loads the listings/index view
     *
     * @return void
     * @throws Exception
     */
    public function index(): void
    {
        // Fetching all the listings
        $listings = $this->db->query('SELECT * FROM listings')->fetchAll();
        loadView('listings/index', ['listings' => $listings]);
    }

    /**
     * Loads the listings/create view
     *
     * @return void
     */
    public function create(): void
    {
        loadView('listings/create');
    }

    /**
     * Fetches the id from the request and loads the listings/show view
     *
     * @return void
     * @throws Exception
     */
    public function show(): void
    {
        // Getting the listing id from the URL
        $id = htmlspecialchars($_GET['id']) ?? null;
        if (!empty($id)) {
            // Fetching all the listings
            $listing = $this->db->query('SELECT * FROM listings WHERE id=:id', ['id' => $id])->fetch();

            loadView('listings/show', ['listing' => $listing]);
        } else {
            goToPath();
        }
    }
}
