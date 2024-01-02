<?php

namespace Framework\Middleware;

use Framework\Session;

class Authorize
{
    /**
     * Check if user is authenticated
     */
    public function isAuthenticated(): bool
    {
        return Session::has('user');
    }

    /**
     * Handle the users request authorization
     */
    public function handle(string $role): void
    {
        if ($role === 'guest' && $this->isAuthenticated()) {
            redirect();
        } elseif ($role === 'auth' && !$this->isAuthenticated()) {
            redirect('/auth/login');
        }
    }
}
