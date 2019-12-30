<?php

declare(strict_types=1);

namespace User\Util;

use App\Util\Enum\StatusHttp;
use App\Util\Enum\ErrorMessage;
use User\Exception\PasswordException;
use User\Util\CreateValidatePasswordInterface;

class CreateValidatePassword implements CreateValidatePasswordInterface
{
    /**
     * Transforma a senha em um texto criptografado
     * @param mixed $password
     * @return string
     */
    public function makePassword($password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * Verifica se a senha é igual a senha que está criptografada
     * @param String $password
     * @param String $hashedPassword
     * @return bool|null
     */
    public function validatePassword(string $password, string $hashedPassword): ?bool
    {
        if (!password_verify($password, $hashedPassword)) {
            throw new PasswordException(
                StatusHttp::UNAUTHORIZED,
                ErrorMessage::ERROR_LOGIN_OR_PASSWORD_INCORRECT
            );
        }
        return true;
    }
}
