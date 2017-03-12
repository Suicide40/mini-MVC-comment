<?php

namespace TestProject\Container;


interface IDIContainerBuilder
{
    /**
     * Create and configure DI-container
     *
     * @param array $config
     * @return IDIContainer
     */
    public function build($config);
}