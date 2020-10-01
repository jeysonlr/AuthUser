<?php

declare(strict_types=1);

namespace App\Util\Enum;

class ErrorMessage
{
    # Erro ao consultar um registro
    const ERROR_QUERY_A_RECORD = "Ocorreu um erro ao consultar ";

    # Erro ao consultar todos os resgitros
    const ERROR_QUERY_ALL_RECORD = "Ocorreu um erro ao consultar todos os dados!";

    # Erro ao inserir registro
    const ERROR_INSERTING_RECORD = "Ocorreu um erro ao inserir os dados!";

    # Erro ao inserir registro
    const ERROR_REGISTRY_CHANGE = "Ocorreu um erro ao alterar os dados ";

    # Erro ao deletar um arquivo
    const ERROR_DELETING_RECORD = "Ocorreu um erro ao deletar os dados ";

    # Erro ao desserializar uma entidade/DTO
    const ERROR_DESERIALIZATION = "Ocorreu um erro ao desserializar ";

    # Erro de campos nulos
    const ERROR_FIELD_CANNOT_BE_NULL = "Existe(m) campo(s) nulo(s) que são obrigatórios! ";

    # Erro de registro não encontrada
    const ERROR_REGISTER_NOT_FOUND = "Registro %s não encontrado!";

    # Erro de usuário não encontrado
    const ERROR_USER_NOT_FOUND = "Usuário não encontrado!";

    # Erro de email duplicado
    const ERROR_EMAIL_DUPLICATED = "Já existe este email %s registrado em nossa base de dados! Por favor escolha outro email.";

    # Erro de login duplicado
    const ERROR_LOGIN_DUPLICATED = "Já existe este login %s registrado em nossa base de dados! Por favor escolha outro login.";

    # Erro no formato de email
    const ERROR_FORMAT_EMAIL_INVALID = "O email %s não possui um formato válido!";

    # Erro no formato do login
    const ERROR_FORMAT_LOGIN_INVALID = "O campo login não permite letras maiúsculas, numeros, acentos e ou caracteres especiais!";

    # Erro de login
    const ERROR_LOGIN_OR_PASSWORD_INCORRECT = "Login ou senha incorretos!";
}
