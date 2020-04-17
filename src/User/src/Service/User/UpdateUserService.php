<?php

declare(strict_types=1);

namespace User\Service\User;

use User\Entity\User;
use User\Repository\UserRepositoryInterface;
use User\Service\User\UpdateUserServiceInterface;

class UpdateUserService implements UpdateUserServiceInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var GetUserServiceInterface
     */
    private $getUserService;

    public function __construct(
        UserRepositoryInterface $userRepository,
        GetUserServiceInterface $getUserService
    ) {
        $this->userRepository = $userRepository;
        $this->getUserService = $getUserService;
    }

    /**
     * Busca um usuário pelo idtccusuario
     * @param int $idtccusuario
     * @return User|null
     */
    public function updateByIdTccUser(User $user): void
    {
        $existUser = $this->getUserService->getByIdTccUser(
            $user->getIdTccUsuario()
        );
        $this->userRepository->updateUser($existUser);
    }
}
