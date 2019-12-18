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

    # Erro de filial nao pertencer a empresa
    const ERROR_BRANCH_NOT_BELONG_COMPANY = "A filial %s não pertence a Empresa %s";

    # Erro de empresa nao coincidir  com filial
    const ERROR_COMPANY_DOES_NOT_MATCH_AFFILIATE = "A empresa %s não coincide com a filial %s";

    # Erro de campos nulos
    const ERROR_FIELD_CANNOT_BE_NULL = "Existe(m) campo(s) nulo(s) que são obrigatórios! ";

    # Erro de empresa ou filial nao encontradas
    const ERROR_COMPANY_OR_BRANCH_NOT_FOUND = "Empresa ou filial não encontrada!";

    # Erro de local_saldo não encontrado
    const ERROR_LOCAL_BALANCE_NOT_FOUND = "O idlocalsaldo nao foi encontrado! ";

    # Erro de idPcoLocalSaldo não coincidir com passado pelo usuario
    const ERROR_ID_LOCAL_BALANCE_DO_NOT_MATCH_URL = "O idpcolocalsaldo %s não coincide com o da requisição! ";

    # Erro do idpcolocalsaldo da requisição nao coincidir com o do corpo
    const ERROR_ID_LOCAL_BALANCE_DO_NOT_MATCH_BODY = "O idpcolocalsaldo %s não coincide com o passado no corpo %s! ";

    # Erro de empresa não encontrada
    const ERROR_COMPANY_NOT_FOUND = "Empresa %s não encontrada!";

    # Erro de filial não encontrada
    const ERROR_BRANCH_NOT_FOUND = "Filial %s não encontrada!";

    # Erro de idpcolocalsaldofilial nao pertencer ao localsaldo a ser alterado
    const ERROR_LOCAL_BALACE_BRANCH_DOES_NOT_BELONG_TO_LOCAL_BALANCE = "O idpcolocalsaldofilial %s nao pertence ao idpcolocalsaldo %s!";

    # Erro de registro não encontrada
    const ERROR_REGISTER_NOT_FOUND = "Registro %s não encontrado!";
    # Erro de usuário não encontrado
    const ERROR_USER_NOT_FOUND = "Usuário não encontrado!";

    # Erro de filiais duplicadas
    const ERROR_DUPLICATE_BRANCH = "O idFilial %s esta duplicado! Insira um novo valor!";

    # Erro de idpcousuário não encontrado
    const ERROR_IDPCOUSER_NOT_FOUND = "O idpcousuario %s não foi encontrado!";

    # Erro de idpcolojista não encontrado
    const ERROR_IDPCOSHOPKEEPER_NOT_FOUND = "O idpcolojista %s não foi encontrado!";
}
