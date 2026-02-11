<?php

declare(strict_types=1);

namespace App\Actions\Orders;

use App\DTO\PlaceOrderData;
use App\Repositories\OrderRepository;

final class PlaceOrderAction
{
    public function __construct(private readonly OrderRepository $orders)
    {
    }

    /** @return array<string,mixed> */
    public function execute(PlaceOrderData $data): array
    {
        // Use-case rules can live here (inventory checks, customer rules, etc.)
        return $this->orders->create($data);
    }
}
