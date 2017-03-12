<?php

namespace TestProject;
use TestProject\Container\DIContainerBuilder;
use TestProject\Components\IActionRunner;
use TestProject\Components\IRouter;
use TestProject\Container\IDIContainer;

/**
 * Class MVCApplication
 * @package TestProject
 */
class MVCApplication
{
    /**
     * Di Container key
     */
    const DI_BUILDER_CONFIG_KEY = 'diBuilderClass';

    /**
     * DI-container
     *
     * @var IDIContainer
     */
    private $container = null;

    /**
     * Construction
     *
     * @param string $configPath - путь до файла с конфигами
     * @throws \Exception
     */
    public function __construct($configPath)
    {
        if (!file_exists($configPath)) {
            throw new \Exception('Файл с конфигурациями не найден');
        }

        $config = require_once $configPath;
        $this->validateConfig($config);
        $this->buildDIContainer($config);
    }

    /**
     * Create and configure DI Container
     *
     * @param array $config
     * @throws \Exception
     */
    private function buildDIContainer($config)
    {
        if (!key_exists(self::DI_BUILDER_CONFIG_KEY, $config)) {
            throw new \Exception('Config for DI-builder is not found');
        }
        $builderClass = $config[self::DI_BUILDER_CONFIG_KEY];
        if (!class_exists($builderClass)) {
            throw new \Exception('Class for DI-builder is not found');
        }
        $builder = new $builderClass();
        $this->container = $builder->build($config);
    }

    /**
     * Get router
     *
     * @return IRouter
     */
    private function getRouter()
    {
        return $this->container->get('router');
    }

    /**
     * Get ActionRunner
     *
     * @return IActionRunner
     */
    private function getActionRunner()
    {
        return $this->container->get('actionRunner');
    }

    /**
     * Validate config
     *
     * @param array $configArray config
     * @throws \Exception
     */
    private function validateConfig($configArray)
    {
        if (!is_array($configArray)) {
            throw new \Exception('Config has to be array');
        }
        if (!key_exists(self::DI_BUILDER_CONFIG_KEY, $configArray)) {
            throw new \Exception('Config for DI is not found');
        }
    }

    /**
     * Run the app
     */
    public function run()
    {
        $router = $this->getRouter();
        $uri = $_SERVER['REQUEST_URI'];
        list($controllerClass, $actionName) = $router->resolve($uri);

        $actionRunner = $this->getActionRunner();
        $output = $actionRunner->runAction($controllerClass, $actionName);

        echo $output;
    }
}