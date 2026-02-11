<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTO\PlaceOrderData;

interface OrderRepository
{
    /** @return array<string,mixed> */
    public function create(PlaceOrderData $data): array;
}
