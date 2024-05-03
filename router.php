<?php

class Router {
    private $routes = [];

    public function addRoute($method, $path, $controller) {
        $this->routes[] = ['method' => $method, 'path' => $path, 'controller' => $controller];
    }

    public function handleRequest($method, $uri) {
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && preg_match($route['path'], $uri, $matches)) {
                array_shift($matches); // Remove the full match from the matches array
                $controller = $route['controller'];
                $this->callController($controller, $matches);
                return;
            }
        }
        echo "404 Not Found";
    }

    private function callController($controller, $params) {
        list($class, $method) = explode('@', $controller);
        if (class_exists($class)) {
            $obj = new $class();
            if (method_exists($obj, $method)) {
                call_user_func_array([$obj, $method], $params);
                return;
            }
        }
        echo "500 Internal Server Error";
    }
}


