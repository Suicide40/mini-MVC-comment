<?php

namespace TestProject\Controllers;
use TestProject\Container\IDIContainer;

/**
 * Base Controller for MVC app
 *
 * Class BaseController
 * @package TestProject\Controllers
 */
abstract class BaseController
{
    /**
     * DI-container
     *
     * @var IDIContainer
     */
    private $container = null;

    /**
     * BaseController constructor.
     * @param IDIContainer $container
     */
    function __construct(IDIContainer $container)
    {
        $this->container = $container;
    }

    protected function render($viewName, $params)
    {
        $render = $this->container->get('render');
        return $render->render($viewName, $params);
    }

    /**
     * Getter for container
     *
     * @return IDIContainer
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     *
     * Render JSON data
     * @param $data
     * @return string
     */
    protected function renderJSON($data)
    {
        return json_encode($data);
    }
}