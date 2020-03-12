<?php

declare(strict_types=1);

namespace Authentication\Middleware\Token;

use Psr\Container\ContainerInterface;
use App\Util\Validation\ValidationService;
use Authentication\Service\Token\AuthenticationTokenService;
use Authentication\Middleware\Token\AuthenticationTokenMiddleware;
use Authentication\Util\CheckUser\CreateValidatePassword;

class AuthenticationTokenMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): AuthenticationTokenMiddleware
    {
        $serializeUtil = $container->get(AuthenticationTokenService::class);
        $validationService = $container->get(ValidationService::class);
        $validatePassword = $container->get(CreateValidatePassword::class);
        return new AuthenticationTokenMiddleware(
            $serializeUtil,
            $validationService,
            $validatePassword
        );
    }
}
