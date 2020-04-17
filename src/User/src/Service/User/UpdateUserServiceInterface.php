<?php

declare(strict_types=1);

namespace User\Service\User;

use User\Entity\User;

interface UpdateUserServiceInterface
{
    /**
     * @param int $idtccusuario
     * @return User|null
     */
    public function updateByIdTccUser(User $user): void;
}
