<?php

namespace TestProject\Container;

/**
 * Simplest DI-container
 *
 * Class DIContainer
 * @package TestProject\Container
 */
class DIContainer implements IDIContainer
{
    /**
     * Array with services
     *
     * @var array
     */
    private $services = [];

    /**
     * @inheritDoc
     */
    public function get($name)
    {
        if (!key_exists($name, $this->services)) {
            throw new \Exception("Service with name '$name' not found in DI Container");
        }

        return $this->services[$name]($this);
    }

    /**
     * @inheritDoc
     */
    public function set($name, $function)
    {
        $this->services[$name] = $function;
    }

}