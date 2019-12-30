<?php

declare(strict_types=1);

namespace User\Service\User;

use User\Entity\User;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use User\Service\User\GetUserService;
use User\Service\User\UpdateUserService;

class UpdateUserServiceFactory
{
    public function __invoke(ContainerInterface $container): UpdateUserService
    {
        $entityManager = $container->get(EntityManager::class);
        $userRepository = $entityManager->getRepository(User::class);
        $getUserService = $container->get(GetUserService::class);
        return new UpdateUserService(
            $userRepository,
            $getUserService
        );
    }
}
