<?php

declare(strict_types=1);

namespace User\Util;

interface CreateValidatePasswordInterface
{
    /**
     * Transforma a senha em um texto criptografado
     * @param mixed $password
     * @return string
     */
    public function makePassword($password): string;

    /**
     * Verifica se a senha é igual a senha que está criptografada
     * @param String $password
     * @param String $hashedPassword
     * @return bool|null
     */
    public function validatePassword(String $password, String $hashedPassword): ?bool;
}
