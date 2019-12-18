<?php

declare(strict_types=1);

namespace User\Service\User;

use App\Util\Pagination\Filters;
use User\Entity\User;
use User\Repository\UserRepositoryInterface;
use User\Service\User\InsertUserServiceInterface;

class InsertUserService extends Filters implements InsertUserServiceInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * Faz o insert na tabelade usuário
     *
     * @param  mixed $user
     * @return void
     */
    public function insertUser(User $user): void
    {
        $this->userRepository->insertUser($user);
    }
}
