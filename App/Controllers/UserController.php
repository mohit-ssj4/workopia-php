<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;
use Framework\Session;
use JetBrains\PhpStorm\NoReturn;

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
        $city = $_POST["city"] ?? null;
        $state = $_POST["state"] ?? null;
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
                'user' => [
                    'name' => $name,
                    'email' => $email,
                    'city' => $city,
                    'state' => $state
                ]]);
            exit();
        }

        // Check if email exists
        $params = [
            'email' => $email
        ];
        $user = $this->db->query('SELECT * FROM users WHERE email=:email', $params)->fetch();
        if ($user) {
            $errors['email'] = 'Email already exists';
            loadView('users/create', [
                'errors' => $errors,
                'user' => [
                    'name' => $name,
                    'email' => $email,
                    'city' => $city,
                    'state' => $state
                ]]);
            exit();
        }

        // Create user in the DB
        $params = [
            'name' => $name,
            'email' => $email,
            'city' => $city,
            'state' => $state,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];
        $this->db->query('INSERT INTO users (name, email, city, state, password) VALUES (:name, :email, :city, :state, :password)',
            $params
        );

        // Get the user id
        $userId = $this->db->conn->lastInsertId();
        Session::set('user', [
            'id' => $userId,
            'name' => $name,
            'email' => $email,
            'city' => $city,
            'state' => $state,
        ]);

        redirect();
    }

    /**
     * Log out a user and kills session
     */
    #[NoReturn] public function logout(): void
    {
        Session::clearAll();
        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 86400, $params['path'], $params['domain']);
        redirect();
    }
}
