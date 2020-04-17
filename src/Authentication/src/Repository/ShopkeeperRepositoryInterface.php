<?php

declare(strict_types=1);

namespace Authentication\Repository;

use Authentication\Entity\PcoShopkeeperEntity;

interface ShopkeeperRepositoryInterface
{
    public function findShopkeeperById(int $idShopkeeper): ?PcoShopkeeperEntity;
}
