<?php

define('BASE_PATH', realpath(dirname(__DIR__)));

require_once BASE_PATH . '/vendor/autoload.php';

$configPath =  BASE_PATH . '/config/main.php';

$app = new \TestProject\MVCApplication($configPath);
$app->run();