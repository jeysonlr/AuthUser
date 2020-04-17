<?php

declare(strict_types=1);

namespace User\Service\User;

use User\Entity\User;

interface InsertUserServiceInterface
{
    /**
     * @param User $user
     */
    public function insertUser(User $user): void;
}
