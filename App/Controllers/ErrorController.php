<?php

namespace App\Controllers;

use Exception;

class ErrorController
{
    /**
     * 404 resource not found
     *
     * @param string $message
     *
     * @return void
     * @throws Exception
     */
    public static function notFound(string $message = 'Resource not found'): void
    {
        http_response_code(404);
        loadView('error', ['status' => 404, 'message' => $message]);
    }

    /**
     * 403 unauthorized
     *
     * @param string $message
     *
     * @return void
     * @throws Exception
     */
    public static function unauthorized(string $message = 'You are not authorized to view this resource'): void
    {
        http_response_code(403);
        loadView('error', ['status' => 403, 'message' => $message]);
    }
}
