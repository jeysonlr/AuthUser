<?php

declare(strict_types=1);

namespace Authentication;

use Zend\Expressive\Application;
use Psr\Container\ContainerInterface;
use Authentication\Handler\AuthenticationTokenHandler;
use Authentication\Middleware\Login\ValidationLoginMiddleware;
use Infrastructure\Middleware\CheckDatabaseConnectionMiddleware;

class RoutesDelegator
{
    /**
     * @var Application
     */
    private $app;

    public function __invoke(ContainerInterface $container, string $serviceName, callable $callback): Application
    {
        $this->app = $callback();

        # LOGIN
        $this->app->post("/v1/login", [
            // CheckDatabaseConnectionMiddleware::class,
            ValidationLoginMiddleware::class,
            AuthenticationTokenHandler::class,
        ], "authentication.post_login");

        return $this->app;
    }
}
