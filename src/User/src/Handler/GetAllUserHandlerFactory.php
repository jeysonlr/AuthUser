<?php

declare(strict_types=1);

namespace User\Handler;

use User\Handler\GetAllUserHandler;
use Psr\Container\ContainerInterface;
use User\Service\User\GetUserService;

class GetAllUserHandlerFactory
{
    public function __invoke(ContainerInterface $container) : GetAllUserHandler
    {
        $getUserService = $container->get(GetUserService::class);
        return new GetAllUserHandler(
            $getUserService
        );
    }
}
