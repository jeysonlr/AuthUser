<?php

declare(strict_types=1);

namespace Authentication\Container;

use GuzzleHttp\Client;
use Psr\Container\ContainerInterface;

class GuzzleFactory
{
    public function __invoke(ContainerInterface $container): Client
    {
        return new Client();
    }
}
