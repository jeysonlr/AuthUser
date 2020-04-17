<?php

declare(strict_types=1);

namespace Authentication\Handler;

use Psr\Container\ContainerInterface;
use Authentication\Handler\AuthenticationTokenHandler;
use Authentication\Service\Token\AuthenticationTokenService;

class AuthenticationTokenHandlerFactory
{
    public function __invoke(ContainerInterface $container): AuthenticationTokenHandler
    {
        $authenticationTokenService = $container->get(AuthenticationTokenService::class);
        return new AuthenticationTokenHandler($authenticationTokenService);
    }
}
