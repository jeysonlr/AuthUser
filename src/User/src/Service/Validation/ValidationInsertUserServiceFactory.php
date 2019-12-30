<?php

declare(strict_types=1);

namespace User\Service\Validation;

use Psr\Container\ContainerInterface;
use User\Service\User\GetUserService;
use User\Service\Validation\ValidationInsertUserService;

class ValidationInsertUserServiceFactory
{
    public function __invoke(ContainerInterface $container): ValidationInsertUserService
    {
        $getuserService = $container->get(GetUserService::class);
        return new ValidationInsertUserService(
            $getuserService
        );
    }
}
