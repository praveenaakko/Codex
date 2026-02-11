<?php

declare(strict_types=1);

namespace App\DTO;

final readonly class PlaceOrderData
{
    public function __construct(
        public int $customerId,
        public string $sku,
        public int $quantity,
        public float $unitPrice,
    ) {
    }

    public function totalAmount(): float
    {
        return $this->quantity * $this->unitPrice;
    }
}
