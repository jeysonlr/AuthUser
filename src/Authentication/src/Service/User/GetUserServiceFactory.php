<?php

declare(strict_types=1);

namespace Authentication\Service\User;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use Authentication\Entity\User;
use Authentication\Service\User\GetUserService;

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
