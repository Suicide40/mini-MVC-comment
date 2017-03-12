<?php

namespace TestProject\Components;


use TestProject\Container\IDIContainer;

class ActionRunner implements IActionRunner
{
    /**
     * Prefix for action method
     */
    const ACTION_PREFIX = 'action';

    /**
     * Postfix for controller classes
     */
    const CONTROLLER_POSTFIX = 'Controller';

    /**
     * Namespace of controllers
     */
    const CONTROLLER_NAMESPACE = 'TestProject\Controllers';

    /**
     * DI-container
     *
     * @var IDIContainer
     */
    private $container = null;

    public function __construct(IDIContainer $container)
    {
        $this->container = $container;
    }

    /**
     * @inheritdoc
     */
    public function runAction($controllerClass, $actionName)
    {
        $nsControllerClass = self::CONTROLLER_NAMESPACE . '\\' . ucfirst($controllerClass . self::CONTROLLER_POSTFIX);

        if (!class_exists($nsControllerClass)) {
            throw new \Exception("Controller with name '$nsControllerClass' can not be fond");
        }

        $controller = new $nsControllerClass($this->container);

        $methodName = $this->getMethodName($actionName);

        if (!method_exists($controller, $methodName)) {
            throw new \Exception("Controller '$controllerClass' doesnt have method '$methodName'");
        }

         return $controller->$methodName();
    }

    /**
     * build method name for calling in controller
     *
     * @param string $actionName
     * @return string
     */
    private function getMethodName($actionName)
    {
        return self::ACTION_PREFIX . $actionName;
    }

}