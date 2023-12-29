<?php

use JetBrains\PhpStorm\NoReturn;

class Router
{
    protected array $routes = [];

    /**
     * Registers a route
     *
     * @param string $method
     * @param string $uri
     * @param string $controller
     */
    public function registerRoute(string $method, string $uri, string $controller): void
    {
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller
        ];
    }

    /**
     * Adds a GET route
     *
     * @params string $uri
     * @params string $controller
     */
    public function get(string $uri, string $controller): void
    {
        $this->registerRoute('GET', $uri, $controller);
    }

    /**
     * Adds a POST route
     *
     * @params string $uri
     * @params string $controller
     */
    public function post(string $uri, string $controller): void
    {
        $this->registerRoute('POST', $uri, $controller);
    }

    /**
     * Adds a PUT route
     *
     * @params string $uri
     * @params string $controller
     */
    public function put(string $uri, string $controller): void
    {
        $this->registerRoute('PUT', $uri, $controller);
    }

    /**
     * Adds a DELETE route
     *
     * @params string $uri
     * @params string $controller
     */
    public function delete(string $uri, string $controller): void
    {
        $this->registerRoute('DELETE', $uri, $controller);
    }

    /**
     * Loads error page
     *
     * @param int $httpCode
     */
    #[NoReturn] public function error(int $httpCode = 404): void
    {
        http_response_code($httpCode);
        require basePath("controllers/error/{$httpCode}.php");
        exit();
    }

    /**
     * Routes a request
     *
     * @param string $uri
     * @param string $method
     */
    public function route(string $uri, string $method): void
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === $method) {
                require basePath('App/' . $route['controller']);

                return;
            }
        }

        $this->error();
    }
}
