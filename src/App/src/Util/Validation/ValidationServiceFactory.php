<?php

declare(strict_types=1);

namespace App\Util\Validation;

use Psr\Container\ContainerInterface;
use Symfony\Component\Validator\Validation;

class ValidationServiceFactory
{
    public function __invoke(ContainerInterface $container): ValidationService
    {
        $validationEntity = $container->get(Validation::class);
        return new ValidationService($validationEntity);
    }
}
