<?php

declare(strict_types=1);

// use JSoumelidis\SymfonyDI\Config\Config;
// use JSoumelidis\SymfonyDI\Config\ContainerFactory;

// $config  = require realpath(__DIR__) . '/config.php';
// $factory = new ContainerFactory();

// return $factory(new Config($config));

use Zend\ServiceManager\ServiceManager;

// Load configuration
$config = require __DIR__ . '/config.php';

$dependencies = $config['dependencies'];
$dependencies['services']['config'] = $config;

// Build container
return new ServiceManager($dependencies);