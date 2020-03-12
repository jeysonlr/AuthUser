<?php

declare(strict_types=1);

namespace Authentication\Middleware\Authorization;

use Authentication\Middleware\Token\AuthenticationTokenMiddleware;
use Psr\Container\ContainerInterface;

class AuthorizationUserMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): AuthorizationUserMiddleware
    {
        $authenticationTokenMiddleware = $container->get(AuthenticationTokenMiddleware::class);
        $routes = $container->get('config')['routes'];
        return new AuthorizationUserMiddleware(
            $authenticationTokenMiddleware,
            $routes
        );
    }
}
