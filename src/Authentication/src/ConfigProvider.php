<?php

declare(strict_types=1);

namespace Authentication;

use Doctrine\ORM\EntityManager;
use Zend\Expressive\Application;
use Authentication\RoutesDelegator;
use Authentication\Container\JWTFactory;
use Authentication\Container\GuzzleFactory;
use Authentication\Service\User\GetUserService;
use ContainerInteropDoctrine\EntityManagerFactory;
use Authentication\Handler\AuthenticationTokenHandler;
use Authentication\Service\User\GetUserServiceFactory;
use Authentication\Util\CheckUser\CreateValidatePassword;
use Authentication\Service\Token\AuthenticationTokenService;
use Authentication\Handler\AuthenticationTokenHandlerFactory;
use Authentication\Middleware\Login\ValidationLoginMiddleware;
use Authentication\Middleware\Token\AuthenticationTokenMiddleware;
use Authentication\Service\Token\AuthenticationTokenServiceFactory;
use Authentication\Middleware\Login\ValidationLoginMiddlewareFactory;
use Authentication\Middleware\Authorization\AuthorizationUserMiddleware;
use Authentication\Middleware\Token\AuthenticationTokenMiddlewareFactory;
use Authentication\Middleware\Authorization\AuthorizationUserMiddlewareFactory;
use Authentication\Util\CheckUser\CreateValidatePasswordFactory;

/**
 * The configuration provider for the Authentication module
 *
 * @see https://docs.zendframework.com/zend-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
            'delegators' => [
                Application::class => [RoutesDelegator::class]
            ],
            'invokables' => [
            ],
            'factories'  => [
                EntityManager::class => EntityManagerFactory::class,
                AuthenticationTokenHandler::class => AuthenticationTokenHandlerFactory::class,
                AuthenticationTokenService::class => AuthenticationTokenServiceFactory::class,
                AuthenticationTokenMiddleware::class => AuthenticationTokenMiddlewareFactory::class,
                AuthorizationUserMiddleware::class => AuthorizationUserMiddlewareFactory::class,
                JWTFactory::class => JWTFactory::class,
                GuzzleFactory::class => GuzzleFactory::class,
                ValidationLoginMiddleware::class => ValidationLoginMiddlewareFactory::class,
                GetUserService::class => GetUserServiceFactory::class,
                CreateValidatePassword::class => CreateValidatePasswordFactory::class,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates() : array
    {
        return [
            'paths' => [
                'authentication'    => [__DIR__ . '/../templates/'],
            ],
        ];
    }
}
