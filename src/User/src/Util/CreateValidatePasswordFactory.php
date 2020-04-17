<?php

declare(strict_types=1);

namespace User\Util;

use Psr\Container\ContainerInterface;
use User\Util\CreateValidatePassword;

class CreateValidatePasswordFactory
{
    public function __invoke(ContainerInterface $container): CreateValidatePassword
    {
        return new CreateValidatePassword();
    }
}