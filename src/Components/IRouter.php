<?php

namespace TestProject\Components;

/**
 * Router for MVC
 *
 * Interface IRouter
 * @package TestProject\Components
 */
interface IRouter
{
    /**
     * Convert URI to controller and action names
     *
     * @param string $uri
     * @return array [controllerName, actionName]
     */
    public function resolve($uri);
}