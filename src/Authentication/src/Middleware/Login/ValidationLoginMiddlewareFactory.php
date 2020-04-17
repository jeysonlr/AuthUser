<?php

declare(strict_types=1);

namespace Authentication\Middleware\Login;

use App\Util\Serialize\SerializeUtil;
use Psr\Container\ContainerInterface;
use App\Util\Validation\ValidationService;
use Authentication\Service\User\GetUserService;
use Authentication\Util\CheckUser\CreateValidatePassword;
use Authentication\Middleware\Login\ValidationLoginMiddleware;

class ValidationLoginMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): ValidationLoginMiddleware
    {
        $serializeUtil = $container->get(SerializeUtil::class);
        $validationService = $container->get(ValidationService::class);
        $getUserService = $container->get(GetUserService::class);
        $validatePassword = $container->get(CreateValidatePassword::class);
        return new ValidationLoginMiddleware(
            $serializeUtil,
            $validationService,
            $getUserService,
            $validatePassword
        );
    }
}
