<?php

declare(strict_types=1);

namespace User\Service\User;

use User\Entity\User;
use App\Util\Pagination\Filters;
use User\Repository\UserRepositoryInterface;
use User\Util\CreateValidatePasswordInterface;
use User\Service\User\InsertUserServiceInterface;

class InsertUserService extends Filters implements InsertUserServiceInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var CreateValidatePasswordInterface
     */
    private $passwordHash;

    public function __construct(
        UserRepositoryInterface $userRepository,
        CreateValidatePasswordInterface $passwordHash
    ) {
        $this->userRepository = $userRepository;
        $this->passwordHash = $passwordHash;
    }

    /**
     * Faz o insert na tabela de usuário
     *
     * @param  mixed $user
     * @return void
     */
    public function insertUser(User $user): void
    {
        $user->setTccSenha($this->passwordHash->makePassword($user->getTccSenha()));
        $user->setTccLogin(strtolower($user->getTccLogin()));
        $this->userRepository->insertUser($user);
    }
}
