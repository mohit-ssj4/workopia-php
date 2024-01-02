<?php

namespace Framework;

class Session
{
    /**
     * Starts a session
     */
    public static function start(): void
    {
        // If no session is active then start a session
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Set a session key/value pair
     */
    public static function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Gets a session key/value pair
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        return $_SESSION[$key] ?? $default;
    }

    /**
     * Check if session key exists
     */
    public static function has(string $key): bool
    {
        return !empty($_SESSION[$key]);
    }

    /**
     * Clear session by key
     */
    public static function clear(string $key): void
    {
        if (self::has($key)) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * Clears all the session data
     */
    public static function clearAll(): void
    {
        session_unset();
        session_destroy();
    }
}
