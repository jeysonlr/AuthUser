<?php

declare(strict_types=1);

namespace Authentication\Util\CheckUser;

use App\Util\Enum\StatusHttp;
use Authentication\Exception\BodyException;

class CreateValidatePassword
{
    /**
     * Transforma a senha em um texto criptografado
     * @param mixed $password
     * @return string
     */
    public function makePassword($password): String
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * Verifica se a senha é igual a senha que está criptografada
     * @param String $password
     * @param String $hashedPassword
     * @param string $message
     * @return bool|null
     * @throws BodyException
     */
    public function validatePassword(
        String $password,
        String $hashedPassword,
        string $message = "O login ou senha estão incorretos!"
    ): ?bool {
        if (!password_verify($password, $hashedPassword)) {
            throw new BodyException(
                StatusHttp::UNAUTHORIZED,
                $message,
                null,
                StatusHttp::UNAUTHORIZED,
            );
        }
        return true;
    }
}
