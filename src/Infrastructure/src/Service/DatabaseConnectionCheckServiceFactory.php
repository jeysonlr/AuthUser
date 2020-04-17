<?php

declare(strict_types=1);

namespace Infrastructure\Service;

use Psr\Container\ContainerInterface;
use Infrastructure\Service\DatabaseConnectionCheckService;

class DatabaseConnectionCheckServiceFactory
{
    public function __invoke(ContainerInterface $container): DatabaseConnectionCheckService
    {
        return new DatabaseConnectionCheckService($container);
    }
}
