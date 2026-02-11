<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTO\PlaceOrderData;

final class EloquentOrderRepository implements OrderRepository
{
    public function create(PlaceOrderData $data): array
    {
        // In a real app, persist via Eloquent model and return resource payload.
        return [
            'id' => random_int(1000, 9999),
            'customer_id' => $data->customerId,
            'sku' => $data->sku,
            'quantity' => $data->quantity,
            'unit_price' => $data->unitPrice,
            'total_amount' => $data->totalAmount(),
        ];
    }
}
