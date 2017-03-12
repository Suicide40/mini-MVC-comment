<?php

namespace TestProject\Components;


class Router implements IRouter
{
    /**
     * Config
     *
     * @var array
     */
    private $routes = [];

    /**
     * Router constructor.
     * @param array $routes
     * @throws \Exception
     */
    public function __construct($routes = [])
    {
        if (!is_array($routes)) {
            throw new \Exception('Config for Route has to be an array');
        }

        $this->routes = $routes;
    }

    /**
     * @inheritdoc
     */
    public function resolve($uri)
    {
        if (!key_exists($uri, $this->routes)) {
            throw new \Exception("Router can not resolve URI '$uri'");
        }

        $ac = explode('/', $this->routes[$uri]);

        if (count($ac) !== 2) {
            throw new \Exception('Config for Router is invalid');
        }

        return [$ac[0], $ac[1]];
    }
}