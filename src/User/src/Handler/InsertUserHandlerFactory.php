<?php

declare(strict_types=1);

namespace User\Handler;

use User\Handler\InsertUserHandler;
use App\Util\Serialize\SerializeUtil;
use Psr\Container\ContainerInterface;
use User\Service\User\InsertUserService;

class InsertUserHandlerFactory
{
    public function __invoke(ContainerInterface $container): InsertUserHandler
    {
        $insertUserService = $container->get(InsertUserService::class);
        $serializeUtil = $container->get(SerializeUtil::class);
        return new InsertUserHandler(
            $insertUserService,
            $serializeUtil
        );
    }
}
