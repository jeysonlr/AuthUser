<?php

declare(strict_types=1);

namespace User\Service\User;

use User\Entity\User;
use App\Util\Pagination\Filters;
use User\Repository\UserRepositoryInterface;
use User\Service\User\GetUserServiceInterface;

class GetUserService extends Filters implements GetUserServiceInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Busca um usuário pelo idtccusuario
     * @param int $idtccusuario
     * @return User|null
     */
    public function getByIdTccUser(int $idtccusuario): ?User
    {
        return $this->userRepository->findByIdTccUsuario($idtccusuario);
    }

    /**
     * Busca todos os registros
     * @return array
     */
    public function getAllUsers(): ?array
    {
        return $this->userRepository->findAllUsers($this->getFilters());
    }
}
