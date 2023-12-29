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
     * @param array $params
     * @return void
     * @throws Exception
     */
    public function show(array $params): void
    {
        $id = htmlspecialchars($params['id']) ?? null;
        // Fetching all the listings
        $listing = $this->db->query('SELECT * FROM listings WHERE id=:id', ['id' => $id])->fetch();

        if (empty($listing)) {
            ErrorController::notFound('Listing not found');
            return;
        }

        loadView('listings/show', ['listing' => $listing]);
    }
}
