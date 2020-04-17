<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Container\MonologFactory;
use Psr\Container\ContainerInterface;

class MonologMiddlewareFactory
{
    public function __invoke(ContainerInterface $container) : MonologMiddleware
    {
        $monolog = $container->get(MonologFactory::class);
        return new MonologMiddleware($monolog);
    }
}
