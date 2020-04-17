<?php

declare(strict_types=1);

namespace Authentication\Util\CheckUser;

use Psr\Container\ContainerInterface;
use Authentication\Util\CheckUser\CreateValidatePassword;

class CreateValidatePasswordFactory
{
    public function __invoke(ContainerInterface $container): CreateValidatePassword
    {
        return new CreateValidatePassword();
    }
}
