<?php

declare(strict_types=1);

namespace User\Repository;

use App\DTO\Pagination\RequestFilters;
use User\Entity\User;

interface UserRepositoryInterface
{
    /**
     * Faz o insert na tabela User
     * @param mixed $user
     * @return void
     */
    public function insertUser(User $user): void;

    /**
     * Faz o update na tabela User
     * @param mixed $user
     * @return void
     */
    public function updateUser(User $user): void;

    /**
     * Faz a busca de um usuario através do idtccusuario
     * @param mixed $idtccusuario
     * @return User
     */
    public function findByIdTccUsuario(int $idtccusuario): ?User;

    
    /**
     * Faz a busca de todos os usuários na entidade Users
     *
     * @param  mixed $requestFilters
     * @return array
     */
    public function findAllUsers(RequestFilters $requestFilters): ?array;

    /**
     * Faz a busca de um usuario através do login
     * @param mixed $login
     * @return User
     */
    public function findByLoginTccUsuario(string $login): ?User;

    /**
     * Faz a busca de um usuario através do email
     * @param mixed $email
     * @return User
     */
    public function findByEmailTccUsuario(string $email): ?User;
}
