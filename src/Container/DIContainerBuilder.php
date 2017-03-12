<?php

namespace TestProject\Container;

use TestProject\Components\ActionRunner;
use TestProject\Components\Router;
use TestProject\Components\ViewRender;
use TestProject\Db\DbManager;
use TestProject\Db\OrmDbManager;
use TestProject\Db\OrmMapper;
use TestProject\Models\Comment;

class DIContainerBuilder implements IDIContainerBuilder
{

    /**
     * @inheritdoc
     */
    public function build($config)
    {
        $container = new DIContainer();

        $container->set('config', function($container) use ($config) {
            return $config;
        });

        $container->set('render', function($container) {
            return new ViewRender();
        });

        $container->set('actionRunner', function($container) {
            $render = $container->get('render');
            return new ActionRunner($container);
        });

        $container->set('router', function ($container) {
            $configs = $container->get('config');
            $routes = $configs['routes'];
            return new Router($routes);
        });

        $container->set('sqlManager', function($container) {
            $config = $container->get('config');
            $dsn = $config['db']['dsn'];
            $username = $config['db']['username'];
            $password = $config['db']['password'];
            return new DbManager($dsn, $username, $password);
        });

        $container->set('ormMapper', function($container) {
            return new OrmMapper();
        });

        $container->set('ormManager', function($container) {
            $sqlManager = $container->get('sqlManager');
            $ormMapper = $container->get('ormMapper');
            return new OrmDbManager($sqlManager, $ormMapper);
        });

        $container->set('commentModel', function($container) {
            $ormManager = $container->get('ormManager');
            return new Comment($ormManager);
        });

        return $container;
    }
}