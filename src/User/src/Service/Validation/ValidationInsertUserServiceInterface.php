<?php

declare(strict_types=1);

namespace User\Service\Validation;


interface ValidationInsertUserServiceInterface
{
    /**
     * Verifica se existe o email
     *
     * @param  mixed $email
     * @return void
     */
    public function existEmail(string $email): void;

    /**
     * Verifica se existe o login
     *
     * @param  mixed $login
     * @return void
     */
    public function existLogin(string $login): void;

    /**
     * Verifica se o formato de email é valido
     *
     * @param  mixed $email
     * @return void
     */
    public function formatEmailIsValid(string $email): void;

    /**
     * Verifica se o login nao possui acentos e caracteres especiais
     *
     * @param string $login
     */
    public function formatLoginValid(string $login): void;

    /**
     * Verifica se senha possui um formato válido
     *
     * @param string $password
     */
    public function formatPasswordValid(string $password): void;
}
