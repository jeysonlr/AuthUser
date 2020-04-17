<?php

declare(strict_types=1);

namespace User\Service\User;

use User\Entity\User;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use User\Service\User\InsertUserService;
use User\Util\CreateValidatePassword;

class InsertUserServiceFactory
{
    public function __invoke(ContainerInterface $container): InsertUserService
    {
        $entityManager = $container->get(EntityManager::class);
        $userRepository = $entityManager->getRepository(User::class);
        $passwordHash = $container->get(CreateValidatePassword::class);
        return new InsertUserService(
            $userRepository,
            $passwordHash
        );
    }
}
