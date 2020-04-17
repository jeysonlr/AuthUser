<?php

declare(strict_types=1);

namespace App\Handler;

use Exception;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\ResultSetMapping;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class HomePageHandler implements RequestHandlerInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(
        ContainerInterface $container
    ) {
        $this->container = $container;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $entityManager = $this->container->get(EntityManager::class);

            $sql = "select tccnome from tcc_usuario";

            $r = new ResultSetMapping();

            $r->addScalarResult("tccnome", "tccnome");

            $q = $entityManager->createNativeQuery($sql, $r);

            print_r($q->getResult());
            exit;


            $a = $entityManager->getConnection()->connect();
            var_dump($a, 'oiii');
            exit;
        } catch (Exception $e) {
            print_r($e->getMessage());
            exit;

            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}
