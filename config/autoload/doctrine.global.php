<?php

declare(strict_types=1);

// use Doctrine\DBAL\Driver\DrizzlePDOMySql\Driver;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain;
use Doctrine\DBAL\Driver\PDOPgSql\Driver;

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'params' => [
                    'driverClass' => Driver::class,
                    'driverOptions' => array(PDO::ATTR_EMULATE_PREPARES => true),
                    'charset' => 'utf8',
                    'host' => 'tuffi.db.elephantsql.com',
                    'port' => '5432',
                    'user' => 'inoepokz',
                    'password' => 'v1a_Z3r8m4ocXgdblwef5qZ1RyIFgzqb',
                    'dbname' => 'inoepokz',
                ],
            ],
        ],
        'driver' => [
            'orm_default' => [
                'class' => MappingDriverChain::class,
                'drivers' => [
                    'App\Entity' => 'app_entity',
                    'User\Entity' => 'user_entity',
                    'Authentication\Entity' => 'authentication_entity',
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
            'authentication_entity' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../../src/Authentication/src/Entity'],
            ],
        ],
    ],
];
