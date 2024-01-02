<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;
use Exception;

class UserController
{
    protected Database $db;

    public function __construct()
    {
        // Creating config and Database objects
        $config = require basePath('configs/db.php');
        $this->db = new Database($config);
    }

    /**
     * Loads the register view
     */
    public function create(): void
    {
        loadView('users/create');
    }

    /**
     * Loads the login view
     */
    public function login(): void
    {
        loadView('users/login');
    }

    /**
     * Store user in the database
     */
    public function store(): void
    {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $city = $_POST["city"];
        $state = $_POST["state"];
        $password = $_POST["password"];
        $passwordConfirmation = $_POST["password_confirmation"];

        $errors = [];

        // Validations
        if (!Validation::email($email)) {
            $errors['email'] = 'Please enter a valid email address';
        }
        if (!Validation::string($name, 2, 50)) {
            $errors['name'] = 'Name must be between 2 and 50 characters';
        }
        if (!Validation::string($password, 8)) {
            $errors['password'] = 'Password must be at least 8 characters';
        }
        if (!Validation::match($password, $passwordConfirmation)) {
            $errors['password_confirmation'] = 'Passwords do not match';
        }

        if (!empty($errors)) {
            loadView('users/create', [
                'errors' => $errors,
                'users' => [
                    'name' => $name,
                    'email' => $email,
                    'city' => $city,
                    'state' => $state
                ]]);
        }
    }
}
