<?php

declare(strict_types=1);

namespace User\Handler;

use User\Handler\GetUserByIdHandler;
use Psr\Container\ContainerInterface;
use User\Service\User\GetUserService;

class GetUserByIdHandlerFactory
{
    public function __invoke(ContainerInterface $container): GetUserByIdHandler
    {
        $getUserService = $container->get(GetUserService::class);
        return new GetUserByIdHandler(
            $getUserService
        );
    }
}
