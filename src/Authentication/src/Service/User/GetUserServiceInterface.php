<?php

declare(strict_types=1);

namespace Authentication\Service\User;

use Authentication\Entity\User;

interface GetUserServiceInterface
{
    public function getAll(): array;
    public function getById(int $iduser): ?User;
    public function getOneUserByLogin(string $login): ?User;
    public function getOneUserByEmail(string $email): ?User;
}
