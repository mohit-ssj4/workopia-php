<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;
use Exception;

class UserController
{
    protected $db;

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
}
