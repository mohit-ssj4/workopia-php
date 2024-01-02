<?php

namespace App\Controllers;

use Framework\Database;
use Exception;
use Framework\Validation;
use JetBrains\PhpStorm\NoReturn;

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
     */
    public function create(): void
    {
        loadView('listings/create');
    }

    /**
     * Fetches the id from the request and loads the listings/show view
     *
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

    /**
     * Store the data in the database
     */
    #[NoReturn] public function store(): void
    {
        $allowedFields = [
            'title',
            'description',
            'salary',
            'tags',
            'company',
            'address',
            'city',
            'state',
            'phone',
            'email',
            'requirements',
            'benefits'
        ];
        $newListingData = array_intersect_key($_POST, array_flip($allowedFields));
        $newListingData['user_id'] = 1;
        $newListingData = array_map('sanitize', $newListingData);

        $requiredFields = ['title', 'description', 'email', 'city', 'state', 'salary'];
        $errors = [];
        foreach ($requiredFields as $field) {
            if (empty($newListingData[$field]) || !Validation::string($newListingData[$field])) {
                $errors[$field] = ucfirst($field) . ' is required';
            }
        }

        if (!empty($errors)) {
            // Reload the view with errors
            loadView('listings/create', ['errors' => $errors, 'listing' => $newListingData]);
        } else {
            // Submit to DB
            $fields = [];
            $values = [];
            foreach ($newListingData as $field => $value) {
                $fields[] = $field;
                if ($value === '') {
                    $newListingData[$field] = null;
                }
                $values[] = ':' . $field;
            }
            $values = implode(', ', $values);
            $fields = implode(', ', $fields);

            $query = "INSERT INTO listings ({$fields}) VALUES ({$values})";
            $this->db->query($query, $newListingData);
            redirect('/listings');
        }
    }

    /**
     * Delete a listing
     */
    public function destroy(array $params): void
    {
        $id = htmlspecialchars($params['id']) ?? null;
        $params = ['id' => $id];
        $listing = $this->db->query('SELECT * FROM listings WHERE id=:id', $params)->fetch();
        if (!$listing) {
            ErrorController::notFound('Listing not found');
            return;
        }
        $this->db->query('DELETE FROM listings WHERE id=:id', $params);
        redirect('/listings');
    }
}
