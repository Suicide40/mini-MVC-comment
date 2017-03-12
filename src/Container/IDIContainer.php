<?php

namespace TestProject\Container;


interface IDIContainer
{
    /**
     * Get from container
     *
     * @param string $name
     * @return mixed
     */
    public function get($name);

    /**
     * Set to container
     *
     * @param string $name
     * @param object $object
     * @return void
     */
    public function set($name, $object);
}