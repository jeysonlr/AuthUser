<?php

declare(strict_types=1);

namespace App\Handler;

use function get_class;
use Doctrine\ORM\EntityManager;
use App\Handler\HomePageHandler;
use Psr\Container\ContainerInterface;

use Zend\Expressive\Router\RouterInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class HomePageHandlerFactory
{
    public function __invoke(ContainerInterface $container): HomePageHandler
    {
        // $router   = $container->get(RouterInterface::class);
        // $template = $container->has(TemplateRendererInterface::class)
        //     ? $container->get(TemplateRendererInterface::class)
        //     : null;
        // $container = 
        // $entityManager = $container->get(EntityManager::class);

        return new HomePageHandler(
            $container
        );
    }
}
