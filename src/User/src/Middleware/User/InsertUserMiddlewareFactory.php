<?php

declare(strict_types=1);

namespace User\Middleware\User;

use App\Util\Serialize\SerializeUtil;
use Psr\Container\ContainerInterface;
use App\Util\Validation\ValidationService;
use User\Service\Validation\ValidationInsertUserService;

class InsertUserMiddlewareFactory
{
    public function __invoke(ContainerInterface $container) : InsertUserMiddleware
    {
        $serializeUtil = $container->get(SerializeUtil::class);
        $validationUserService = $container->get(ValidationInsertUserService::class);
        $validationEntity = $container->get(ValidationService::class);
        return new InsertUserMiddleware(
            $serializeUtil,
            $validationUserService,
            $validationEntity
        );
    }
}
