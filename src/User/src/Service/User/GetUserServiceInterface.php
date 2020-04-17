<?php

declare(strict_types=1);

namespace User\Service\User;

use User\Entity\User;

interface GetUserServiceInterface
{
    /**
     * @param int $idtccusuario
     * @return User|null
     */
    public function getByIdTccUser(int $idtccusuario): ?User;

    /**
     * @return array
     */
    public function getAllUsers(): ?array;

    /**
     * @param int $login
     * @return User|null
     */
    public function getByLoginTccUser(string $login): ?User;

    /**
     * @param int $email
     * @return User|null
     */
    public function getByEmailTccUser(string $email): ?User;
}
