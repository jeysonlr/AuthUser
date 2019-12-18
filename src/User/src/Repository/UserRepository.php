<?php

declare(strict_types=1);

namespace User\Repository;

use Exception;
use User\Entity\User;
use App\Util\Enum\StatusHttp;
use App\Util\Enum\ErrorMessage;
use Doctrine\ORM\EntityRepository;
use App\DTO\Pagination\RequestFilters;
use User\Exception\UserDatabaseException;
use User\Repository\UserRepositoryInterface;

class UserRepository extends EntityRepository implements UserRepositoryInterface
{
    /**
     * Insere dados na tabela local_saldo
     * @param  mixed $localBalance
     * @return void
     */
    public function insertUser(User $user): void
    {
        try {
            $this->getEntityManager()->persist($user);
            $this->getEntityManager()->flush();
        } catch (Exception $e) {
            throw new UserDatabaseException(
                StatusHttp::INTERNAL_SERVER_ERROR,
                ErrorMessage::ERROR_INSERTING_RECORD,
                $e->getMessage()
            );
        }
    }

    /**
     * Faz update dos dados na tabela local_saldo
     * @param  mixed $localBalance
     * @return void
     */
    public function updateUser(User $user): void
    {
        try {
            $this->getEntityManager()->merge($user);
            $this->getEntityManager()->flush();
        } catch (Exception $e) {
            throw new UserDatabaseException(
                StatusHttp::INTERNAL_SERVER_ERROR,
                ErrorMessage::ERROR_REGISTRY_CHANGE,
                $e->getMessage()
            );
        }
    }

    /**
     * Faz a busca de um registro a partir do IdPcoLocalSaldo
     * @param  mixed $idpcolocalsaldo
     * @return User
     */
    public function findByIdTccUsuario(int $idtccusuario): ?User
    {
        try {
            return $this->getEntityManager()->getRepository(User::class)
                ->findOneBy(['idtccusuario' => $idtccusuario]);
        } catch (Exception $e) {
            throw new UserDatabaseException(
                StatusHttp::INTERNAL_SERVER_ERROR,
                ErrorMessage::ERROR_QUERY_A_RECORD . "idtccusuario",
                $e->getMessage()
            );
        }
    }

    /**
     * Faz a busca de todos os registros na tabela local saldo
     *
     * @param  mixed $requestFilters
     * @return array
     */
    public function findAllUsers(RequestFilters $requestFilters): ?array
    {
        try {
            return $this->getEntityManager()->getRepository(User::class)
                ->findBy(
                    [],
                    ['idtccusuario' => $requestFilters->getOrderBy()],
                    $requestFilters->getLimit(),
                    $requestFilters->getOffSet()
                );
        } catch (Exception $e) {
            throw new UserDatabaseException(
                StatusHttp::INTERNAL_SERVER_ERROR,
                ErrorMessage::ERROR_QUERY_ALL_RECORD,
                $e->getMessage()
            );
        }
    }
}
