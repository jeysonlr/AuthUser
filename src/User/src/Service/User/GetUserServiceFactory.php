<?php

declare(strict_types=1);

namespace User\Service\User;

use User\Entity\User;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use User\Service\User\GetUserService;

class GetUserServiceFactory
{
    public function __invoke(ContainerInterface $container): GetUserService
    {
        $entityManager = $container->get(EntityManager::class);
        $userRepository = $entityManager->getRepository(User::class);
        return new GetUserService(
            $userRepository
        );
    }
}
