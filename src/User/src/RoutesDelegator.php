<?php

declare(strict_types=1);

namespace User;

use Zend\Expressive\Application;
use User\Handler\GetAllUserHandler;
use User\Handler\InsertUserHandler;
use Psr\Container\ContainerInterface;
use LocalBalance\Handler\GetAllLocalBalanceHandler;
use Infrastructure\Middleware\CheckDatabaseConnectionMiddleware;
use Authentication\Middleware\Token\AuthenticationTokenMiddleware;
use User\Handler\GetUserByIdHandler;

class RoutesDelegator
{
    /**
     * @var Application
     */
    private $app;

    public function __invoke(ContainerInterface $container, string $serviceName, callable $callback): Application
    {
        $this->app = $callback();

        $this->app->post('/v1/usuario', [
            InsertUserHandler::class
        ], 'usuario.postusuario');

        $this->app->get('/v1/usuarios', [
            GetAllUserHandler::class
        ], 'usuario.getallusuarios');

        $this->app->get('/v1/usuario/{idtccusuario:\d+}', [
            GetUserByIdHandler::class
        ], 'usuario.getbyidusuario');

        return $this->app;
    }
}
