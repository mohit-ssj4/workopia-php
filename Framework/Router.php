<?php

namespace Framework;

use App\Controllers\ErrorController;
use Framework\Middleware\Authorize;

class Router
{
    protected array $routes = [];

    /**
     * Registers a route
     */
    public function registerRoute(string $method, string $uri, string $action, array $middleware = []): void
    {
        list($controller, $controllerMethod) = explode('@', $action);
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'controllerMethod' => $controllerMethod,
            'middleware' => $middleware
        ];
    }

    /**
     * Adds a GET route
     */
    public function get(string $uri, string $controller, array $middleware = []): void
    {
        $this->registerRoute('GET', $uri, $controller, $middleware);
    }

    /**
     * Adds a POST route
     */
    public function post(string $uri, string $controller, array $middleware = []): void
    {
        $this->registerRoute('POST', $uri, $controller, $middleware);
    }

    /**
     * Adds a PUT route
     */
    public function put(string $uri, string $controller, array $middleware = []): void
    {
        $this->registerRoute('PUT', $uri, $controller, $middleware);
    }

    /**
     * Adds a DELETE route
     */
    public function delete(string $uri, string $controller, array $middleware = []): void
    {
        $this->registerRoute('DELETE', $uri, $controller, $middleware);
    }

    /**
     * Routes a request
     */
    public function route(string $uri): void
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        if ($requestMethod === 'POST' && !empty($_POST['_method'])) {
            $requestMethod = strtoupper($_POST['_method']);
        }

        foreach ($this->routes as $route) {
            // Split the current URI into segments
            $uriSegments = explode('/', trim($uri, '/'));
            // Split the route URI into segments
            $routeSegments = explode('/', trim($route['uri'], '/'));

            $match = true;
            // Check if the number of segments matches
            if (count($uriSegments) === count($routeSegments) && strtoupper($route['method'] === $requestMethod)) {
                $params = [];
                for ($i = 0; $i < count($uriSegments); $i++) {
                    // If the uri's do not match and there is no param
                    if ($routeSegments[$i] !== $uriSegments[$i] && !preg_match('/\{(.+?)\}/', $routeSegments[$i])) {
                        $match = false;
                        break;
                    }

                    // Check for the param and add to $params array
                    if (preg_match('/\{(.+?)\}/', $routeSegments[$i], $matches)) {
                        $params[$matches[1]] = $uriSegments[$i];
                    }
                }

                if ($match) {
                    foreach ($route['middleware'] as $role) {
                        (new Authorize())->handle($role);
                    }
                    $controller = 'App\\Controllers\\' . $route['controller'];
                    $controllerMethod = $route['controllerMethod'];

                    // Instantiate the controller and call the method
                    $controllerInstance = new $controller();
                    $controllerInstance->$controllerMethod($params);

                    return;
                }
            }
        }

        ErrorController::notFound();
    }
}
