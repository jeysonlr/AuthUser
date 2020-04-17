<?php

declare(strict_types=1);

namespace Authentication\Service\Token;

use Psr\Container\ContainerInterface;
use Authentication\Container\JWTFactory;
use Authentication\Service\Token\AuthenticationTokenService;

class AuthenticationTokenServiceFactory
{
    public function __invoke(ContainerInterface $container): AuthenticationTokenService
    {
        $jwt = $container->get(JWTFactory::class);
        $tokenData = $container->get("config")["token_user"];
        return new AuthenticationTokenService($jwt, $tokenData);
    }
}
