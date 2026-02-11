<?php

declare(strict_types=1);

namespace Tests\Feature\ApplicationLayer;

use Tests\TestCase;

final class PlaceOrderControllerTest extends TestCase
{
    public function test_place_order_returns_201_for_valid_payload(): void
    {
        $this->postJson('/api/orders', [
            'customer_id' => 55,
            'sku' => 'BOOK-001',
            'quantity' => 2,
            'unit_price' => 39.5,
        ])->assertStatus(201)
            ->assertJsonPath('status', 'created')
            ->assertJsonPath('data.sku', 'BOOK-001')
            ->assertJsonPath('data.total_amount', 79.0);
    }

    public function test_place_order_returns_422_for_invalid_payload(): void
    {
        $this->postJson('/api/orders', [
            'customer_id' => 0,
            'sku' => '',
            'quantity' => 0,
            'unit_price' => 0,
        ])->assertStatus(422)
            ->assertJsonValidationErrors(['customer_id', 'sku', 'quantity', 'unit_price']);
    }
}
