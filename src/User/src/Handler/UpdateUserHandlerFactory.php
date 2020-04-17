<?php

declare(strict_types=1);

namespace User\Handler;

use App\Util\Serialize\SerializeUtil;
use Psr\Container\ContainerInterface;
use User\Service\User\UpdateUserService;

class UpdateUserHandlerFactory
{
    public function __invoke(ContainerInterface $container) : UpdateUserHandler
    {
        $updateUserService = $container->get(UpdateUserService::class);
        $serializeUtil = $container->get(SerializeUtil::class);
        return new UpdateUserHandler(
            $updateUserService,
            $serializeUtil
        );
    }
}
