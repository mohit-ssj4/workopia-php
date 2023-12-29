<?php

namespace Framework;

use Exception;
use App\Controllers\ErrorController;

class Router
{
    protected array $routes = [];

    /**
     * Registers a route
     *
     * @param string $method
     * @param string $uri
     * @param string $action
     */
    public function registerRoute(string $method, string $uri, string $action): void
    {
        list($controller, $controllerMethod) = explode('@', $action);
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'controllerMethod' => $controllerMethod
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
     * Routes a request
     *
     * @param string $uri
     * @param string $method
     * @throws Exception
     */
    public function route(string $uri, string $method): void
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === $method) {
                // Getting the controller and controllerMethod
                $controller = 'App\\Controllers\\' . $route['controller'];
                $controllerMethod = $route['controllerMethod'];

                // Instantiate the controller
                $controllerInstance = new $controller();
                $controllerInstance->$controllerMethod();

                return;
            }
        }

        ErrorController::notFound();
    }
}
