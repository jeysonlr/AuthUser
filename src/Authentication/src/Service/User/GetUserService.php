<?php

declare(strict_types=1);

namespace Authentication\Service\User;

use App\Util\Pagination\Filters;
use Authentication\Entity\User;
use Authentication\Repository\UserRepository;
use Authentication\Service\User\GetUserServiceInterface;

class GetUserService extends Filters implements GetUserServiceInterface
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * getAll
     *
     * @return array
     */
    public function getAll(): array
    {
        return $this->userRepository->findAllUsers($this->getFilters());
    }

    /**
     * getById
     *
     * @param  mixed $iduser
     *
     * @return User
     */
    public function getById(int $iduser): ?User
    {
        return $this->userRepository->findByIdTccUsuario($iduser);
    }

    /**
     * getOneUserByLogin
     *
     * @param  mixed $login
     *
     * @return User
     */
    public function getOneUserByLogin(string $login): ?User
    {
        return $this->userRepository->findByLoginTccUsuario(strtolower($login));
    }

    /**
     * getOneUserByEmail
     *
     * @param  mixed $email
     *
     * @return User
     */
    public function getOneUserByEmail(string $email): ?User
    {
        return $this->userRepository->findByEmailTccUsuario($email);
    }
}
