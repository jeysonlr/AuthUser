<?php

declare(strict_types=1);

namespace Infrastructure\Middleware;

use Psr\Container\ContainerInterface;
use Infrastructure\Middleware\CheckDatabaseConnectionMiddleware;
use Infrastructure\Service\DatabaseConnectionCheckService;

class CheckDatabaseConnectionMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): CheckDatabaseConnectionMiddleware
    {
        $DatabaseConnectionCheckService = $container->get(DatabaseConnectionCheckService::class);
        $checkDataBaseConection = $container->get('config')['check-connection'];
        return new CheckDatabaseConnectionMiddleware(
            $DatabaseConnectionCheckService,
            $checkDataBaseConection
        );
    }
}
