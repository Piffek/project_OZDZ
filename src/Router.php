<?php

namespace Src;

class Router
{
    private $router;

    /**
     * @param $fileWithRoutes
     * @return static
     */
    public static function load($fileWithRoutes)
    {
        $router = new static;
        include $fileWithRoutes;

        return $router;
    }

    /**
     *
     * Make get request.
     *
     * @param string $url name of URL.
     * @param string $controller name of Controller.
     * @param string $method name of Method.
     */
    public function get(string $url, string $controller, string $method)
    {
        if ($url === Request::getFirstPartOfUrl() && 'GET' === Request::getUrlMethod()) {
            return $this->instanceOfController($controller, $method);
        }
    }

    /**
     *
     * Make post request.
     *
     * @param string $url name of URL.
     * @param string $controller name of Controller.
     * @param string $method name of Method.
     */
    public function post(string $url, string $controller, string $method)
    {
        if ($url === Request::getFirstPartOfUrl() && 'POST' === Request::getUrlMethod()) {
            return $this->instanceOfController($controller, $method);
        }
    }

    /**
     *
     * If method and controller exists, inset this.
     *
     * @param string $controller
     * @param string $method
     * @throws \Exception
     */
    public function instanceOfController(string $controller, string $method)
    {
        $className = '\\App\\Controllers\\'.$controller;

        $class = new $className(Request::groupURLToKeyAndValueAvailableInControllers());

        call_user_func([$class, $method]);
    }
}