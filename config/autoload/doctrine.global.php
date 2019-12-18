<?php

declare(strict_types=1);

// use Doctrine\DBAL\Driver\DrizzlePDOMySql\Driver;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain;

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'params' => [
                    'driverClass' => Doctrine\DBAL\Driver\PDOMySql\Driver::class,
                    'driverOptions' => array(PDO::ATTR_EMULATE_PREPARES => true),
                    'charset' => 'utf8',
                    'host' => '127.0.0.1',
                    'port' => '3308',
                    'user' => 'root',
                    'password' => '',
                    'dbname' => 'tcc',
                    'driverOptions' => [
                        1002 => "SET NAMES 'UTF8'"
                    ]
                ],
            ],
        ],
        'driver' => [
            'orm_default' => [
                'class' => MappingDriverChain::class,
                'drivers' => [
                    'App\Entity' => 'app_entity',
                    'User\Entity' => 'user_entity',
                ],
            ],
            'app_entity' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../../src/App/src/Entity'],
            ],
            'user_entity' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../../src/User/src/Entity'],
            ],
        ],
    ],
];
