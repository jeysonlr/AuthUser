<?php

declare(strict_types=1);

namespace Infrastructure\Service;

interface DatabaseConnectionCheckServiceInterface
{
    /**
     * @return bool
     */
    public function hasConnection(): bool;

    /**
     * @param bool $connected
     */
    public function throwException(bool $connected): void;
}
