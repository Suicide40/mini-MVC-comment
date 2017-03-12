<?php

namespace TestProject\Components;

/**
 * Run action and get output for response
 *
 * Interface IActionRunner
 * @package TestProject\Components
 */
interface IActionRunner
{
    /**
     * Run controller's action and get output for response
     *
     * @param string $controllerClass controller class
     * @param string $actionName action method
     * @return string
     * @throws \Exception
     */
    public function runAction($controllerClass, $actionName);
}