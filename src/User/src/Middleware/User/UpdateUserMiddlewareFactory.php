<?php

declare(strict_types=1);

namespace User\Middleware\User;

use Psr\Container\ContainerInterface;

class UpdateUserMiddlewareFactory
{
    public function __invoke(ContainerInterface $container) : UpdateUserMiddleware
    {
        return new UpdateUserMiddleware();
    }
}
