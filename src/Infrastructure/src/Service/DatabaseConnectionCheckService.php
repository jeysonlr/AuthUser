<?php

declare(strict_types=1);

namespace Infrastructure\Service;

use Exception;
use App\Util\Enum\StatusHttp;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use Infrastructure\Util\Enum\DatabaseErrorMessage;
use Infrastructure\Exception\DatabaseConnectionException;
use Infrastructure\Service\DatabaseConnectionCheckServiceInterface;

class DatabaseConnectionCheckService implements DatabaseConnectionCheckServiceInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var string
     */
    private $internalMessage;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Verifica se o banco de dados esta conectado
     * @return bool
     */
    public function hasConnection(): bool
    {
        try {
            $entityManager = $this->container->get(EntityManager::class);
            return $entityManager->getConnection()->isConnected();
        } catch (Exception $e) {
            $this->internalMessage = $e->getMessage();
            return false;
        }
    }

    /**
     * Lança uma exceção se o banco de dados não estiver conectado
     * @param bool $connected
     * @throws DatabaseConnectionException
     */
    public function throwException(bool $connected): void
    {
        if (!$connected) {
            throw new DatabaseConnectionException(
                StatusHttp::INTERNAL_SERVER_ERROR,
                DatabaseErrorMessage::DB_CONNECTION_ERROR,
                $this->internalMessage
            );
        }
    }
}
