<?php

namespace Authentication\Repository;

use Exception;
use App\Util\Enum\StatusHttp;
use App\Util\Enum\ErrorMessage;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use App\Util\ReadArchive\ReadArchiveSQL;
use Doctrine\ORM\Query\ResultSetMapping;
use Authentication\Entity\PcoShopkeeperEntity;
use Authentication\Exception\UserDatabaseException;
use Authentication\Repository\ShopkeeperRepositoryInterface;

/**
 * @property ResultSetMapping resultSetMapping
 */

class ShopkeeperRepository extends EntityRepository implements ShopkeeperRepositoryInterface
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var ReadArchiveSQL
     */
    private $readSQL;

    /**
     * setInstance
     *
     * @return void
     */
    private function setInstance(): void
    {
        $this->entityManager = $this->getEntityManager();

        parent::__construct(
            $this->entityManager,
            $this->entityManager->getClassMetadata(PcoShopkeeperEntity::class)
        );

        $this->resultSetMapping = new ResultSetMapping();
        $this->readSQL = new ReadArchiveSQL();
    }

    /**
     * findShopkeeperById
     *
     * @param  mixed $idShopkeeper
     *
     * @return PcoShopkeeperEntity
     */
    public function findShopkeeperById(int $idShopkeeper): ?PcoShopkeeperEntity
    {
        try {
            $this->setInstance();
            return $this->entityManager->getRepository(PcoShopkeeperEntity::class)
                ->findOneBy(['idpcolojista' => $idShopkeeper]);
        } catch (Exception $e) {
            throw new UserDatabaseException(
                StatusHttp::INTERNAL_SERVER_ERROR,
                ErrorMessage::ERROR_QUERY_A_RECORD,
                $e->getMessage()
            );
        }
    }
}
