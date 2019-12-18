<?php

declare(strict_types=1);

namespace User;

use User\Handler\GetAllUserHandler;
use User\Handler\GetAllUserHandlerFactory;
use User\Handler\GetUserByIdHandler;
use User\Handler\GetUserByIdHandlerFactory;
use User\RoutesDelegator;
use Zend\Expressive\Application;
use User\Handler\InsertUserHandler;
use User\Service\User\GetUserService;
use User\Service\User\InsertUserService;
use User\Handler\InsertUserHandlerFactory;
use User\Service\User\GetUserServiceFactory;
use User\Service\User\InsertUserServiceFactory;

/**
 * The configuration provider for the User module
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
                InsertUserService::class => InsertUserServiceFactory::class,
                InsertUserHandler::class => InsertUserHandlerFactory::class,
                GetUserService::class => GetUserServiceFactory::class,
                GetAllUserHandler::class => GetAllUserHandlerFactory::class,
                GetUserByIdHandler::class => GetUserByIdHandlerFactory::class,
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
                'user'    => [__DIR__ . '/../templates/'],
            ],
        ];
    }
}
