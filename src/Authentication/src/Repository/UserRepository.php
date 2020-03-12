<?php

declare(strict_types=1);

namespace Authentication\Repository;

use Exception;
use App\Util\Enum\StatusHttp;
use App\Util\Enum\ErrorMessage;
use Authentication\Entity\User;
use Doctrine\ORM\EntityRepository;
use App\DTO\Pagination\RequestFilters;
use Authentication\Exception\UserDatabaseException;
use Authentication\Repository\UserRepositoryInterface;

class UserRepository extends EntityRepository implements UserRepositoryInterface
{
    /**
     * Insere dados na tabela tcc_usuario
     * @param  mixed $user
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
     * Faz update dos dados na tabela tcc_usuario
     * @param  mixed $user
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
     * Faz a busca de um registro a partir do idtccuser
     * @param  mixed $tdtccusuario
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
     * Faz a busca de todos os registros na tabela tcc_usuario
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

    /**
     * Faz a busca de um registro a partir do login
     * @param  mixed $login
     * @return User
     */
    public function findByLoginTccUsuario(string $login): ?User
    {
        try {
            return $this->getEntityManager()->getRepository(User::class)
                ->findOneBy(['tcclogin' => $login]);
        } catch (Exception $e) {
            throw new UserDatabaseException(
                StatusHttp::INTERNAL_SERVER_ERROR,
                ErrorMessage::ERROR_QUERY_A_RECORD . "tcclogin",
                $e->getMessage()
            );
        }
    }

    /**
     * Faz a busca de um registro a partir do email
     * @param  mixed $email
     * @return User
     */
    public function findByEmailTccUsuario(string $email): ?User
    {
        try {
            return $this->getEntityManager()->getRepository(User::class)
                ->findOneBy(['tccemail' => $email]);
        } catch (Exception $e) {
            throw new UserDatabaseException(
                StatusHttp::INTERNAL_SERVER_ERROR,
                ErrorMessage::ERROR_QUERY_A_RECORD . "email",
                $e->getMessage()
            );
        }
    }
}
