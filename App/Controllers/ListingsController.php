<?php

namespace App\Controllers;

use Framework\Database;
use Exception;
use Framework\Validation;
use JetBrains\PhpStorm\NoReturn;
use Framework\Session;
use Framework\Authorization;

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
        $listings = $this->db->query('SELECT * FROM listings ORDER BY created_at DESC')->fetchAll();
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
        $newListingData['user_id'] = Session::get('user')['id'];
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

            // Set flash message
            Session::setFlashMessage('success_message', 'Listing created successfully');

            redirect('/listings');
        }
    }

    /**
     * Delete a listing
     *
     * @throws Exception
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

        // Authorization
        if (!Authorization::isOwner($listing->user_id)) {
            Session::setFlashMessage('error_message', 'You are not authorized to delete this listing');
            redirect("/listings/{$id}");
        }

        $this->db->query('DELETE FROM listings WHERE id=:id', $params);

        // Set flash message
        Session::setFlashMessage('success_message', 'Listing deleted successfully');

        redirect('/listings');
    }

    /**
     * Show the listings edit form
     *
     * @throws Exception
     */
    public function edit(array $params): void
    {
        $id = htmlspecialchars($params['id']) ?? null;
        // Fetching all the listings
        $listing = $this->db->query('SELECT * FROM listings WHERE id=:id', ['id' => $id])->fetch();

        if (empty($listing)) {
            ErrorController::notFound('Listing not found');
            return;
        }

        loadView('listings/edit', ['listing' => $listing]);
    }

    /**
     * Updates a listing
     */
    public function update(array $params): void
    {
        $id = htmlspecialchars($params['id']) ?? null;
        // Fetching all the listings
        $listing = $this->db->query('SELECT * FROM listings WHERE id=:id', ['id' => $id])->fetch();

        if (empty($listing)) {
            ErrorController::notFound('Listing not found');
            return;
        }

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
        $updateValues = array_intersect_key($_POST, array_flip($allowedFields));
        $updateValues['user_id'] = Session::get('user')['id'];
        $updateValues = array_map('sanitize', $updateValues);

        $requiredFields = ['title', 'description', 'email', 'city', 'state', 'salary'];
        $errors = [];
        foreach ($requiredFields as $field) {
            if (empty($updateValues[$field]) || !Validation::string($updateValues[$field])) {
                $errors[$field] = ucfirst($field) . ' is required';
            }
        }

        if (!empty($errors)) {
            // Reload the view with errors
            loadView('listings/edit', ['errors' => $errors, 'listing' => $listing]);
        } else {
            // Submit to DB
            $updateFields = [];
            $values = [];
            foreach (array_keys($updateValues) as $field) {
                $updateFields[] = "{$field} = :{$field}";
            }
            $updateFields = implode(', ', $updateFields);

            $query = "UPDATE listings SET $updateFields WHERE id=:id";
            $updateValues['id'] = $id;
            $this->db->query($query, $updateValues);

            // Set flash message
            Session::setFlashMessage('success_message', 'Listing updated');

            redirect("/listings/{$id}");
        }
    }
}
