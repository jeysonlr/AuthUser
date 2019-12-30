<?php

declare(strict_types=1);

namespace User\Service\Validation;

use App\Util\Enum\StatusHttp;
use App\Util\Enum\ErrorMessage;
use Respect\Validation\Validator;
use User\Exception\ExistEmailException;
use User\Exception\ExistLoginException;
use User\Exception\EmailInvalidException;
use User\Exception\LoginInvalidException;
use User\Exception\InvalidPasswordException;
use User\Service\User\GetUserServiceInterface;
use User\Service\Validation\ValidationInsertUserServiceInterface;

class ValidationInsertUserService implements ValidationInsertUserServiceInterface
{
    /**
     * @var GetUserServiceInterface
     */
    private $getUserService;

    public function __construct(
        GetUserServiceInterface $getUserService
    ) {
        $this->getUserService = $getUserService;
    }

    /**
     * Verifica se ja existe o email cadastrado
     *
     * @param string $user
     * @return void
     */
    public function existEmail(string $email): void
    {
        if ($this->getUserService->getByEmailTccUser($email)) {
            throw new ExistEmailException(
                StatusHttp::UNAUTHORIZED,
                sprintf(
                    ErrorMessage::ERROR_EMAIL_DUPLICATED,
                    $email
                )
            );
        }
    }

    /**
     * Verifica se ja existe o login cadastrado
     *
     * @param string $user
     * @return void
     */
    public function existLogin(string $login): void
    {
        if ($this->getUserService->getByLoginTccUser($login)) {
            throw new ExistLoginException(
                StatusHttp::UNAUTHORIZED,
                sprintf(
                    ErrorMessage::ERROR_LOGIN_DUPLICATED,
                    $login
                )
            );
        }
    }

    /**
     * Verifica se o e-mail possui um formato válido
     *
     * @param string $email
     */
    public function formatEmailIsValid(string $email): void
    {
        $validationCharacterEmail = '/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{3})$/';
        if (!preg_match($validationCharacterEmail, $email)) {
            throw new EmailInvalidException(
                StatusHttp::BAD_REQUEST,
                sprintf(
                    ErrorMessage::ERROR_FORMAT_EMAIL_INVALID,
                    $email
                )
            );
        }
    }

    /**
     * Verifica se o login nao possui acentos e caracteres especiais
     *
     * @param string $login
     */
    public function formatLoginValid(string $login): void
    {
        $loginValid = Validator::regex('/^(?!.*?[\\.|\\-|_]{2})[a-z]{1}[.a-z0-9_-]+[a-z]{1}$/')->validate($login);

        if (!$loginValid) {
            throw new LoginInvalidException(
                StatusHttp::BAD_REQUEST, 
                ErrorMessage::ERROR_FORMAT_LOGIN_INVALID
            );
        }
    }

    /**
     * Verifica se senha possui um formato válido
     *
     * @param string $password
     */
    public function formatPasswordValid(string $password): void
    {
        if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[\w$@]{8,64}$/', $password)) {
        } elseif (!preg_match('/^(?=.*[a-z])/', $password)) {
            throw new InvalidPasswordException(
                StatusHttp::BAD_REQUEST, "Insira ao menos uma letra minúscula na senha!");
        } elseif (!preg_match('/^(?=.*[A-Z])/', $password)) {
            throw new InvalidPasswordException(
                StatusHttp::BAD_REQUEST, "Insira ao menos uma letra maiúscula na senha!");
        } elseif (!preg_match('/^(?=.*[0-9])/', $password)) {
            throw new InvalidPasswordException(
                StatusHttp::BAD_REQUEST, "Insira ao menos um numero na senha!");
        } elseif (!preg_match('/^[\w\/:;#%*$@]{8,16}$/', $password)) {
            throw new InvalidPasswordException(
                StatusHttp::BAD_REQUEST, "Insira uma senha entre 8 e 16 caracteres!");
        }
    } 
}
