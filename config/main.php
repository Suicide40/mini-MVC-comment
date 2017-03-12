<?php
return [
    'diBuilderClass' => \TestProject\Container\DIContainerBuilder::class,
    'routes' => [
        '/' => 'home/index',

        '/api/comments/all' => 'comment/all',
        '/api/comments/update' => 'comment/update',
        '/api/comments/delete' => 'comment/delete',
        '/api/comments/insert' => 'comment/insert',
    ],
    'db' => [
        'dsn' => 'mysql:host=localhost;dbname=test',
        'username' => 'test',
        'password' => 'test'
    ]
];