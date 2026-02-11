<?php

declare(strict_types=1);

namespace Tests\Feature\Middleware;

use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

final class PipelineMiddlewareTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Cache::flush();
    }

    public function test_missing_api_key_returns_401(): void
    {
        $this->postJson('/api/pipeline/orders', ['sku' => 'book'])
            ->assertStatus(401);
    }

    public function test_missing_idempotency_key_returns_422(): void
    {
        $this->withHeaders(['X-Api-Key' => 'local-dev-key'])
            ->postJson('/api/pipeline/orders', ['sku' => 'book'])
            ->assertStatus(422);
    }

    public function test_valid_request_returns_201_with_correlation_id(): void
    {
        $this->withHeaders([
            'X-Api-Key' => 'local-dev-key',
            'Idempotency-Key' => 'idem-1',
        ])->postJson('/api/pipeline/orders', ['sku' => 'book'])
            ->assertStatus(201)
            ->assertHeader('X-Correlation-ID');
    }

    public function test_duplicate_idempotency_key_returns_409(): void
    {
        $headers = [
            'X-Api-Key' => 'local-dev-key',
            'Idempotency-Key' => 'idem-2',
        ];

        $this->withHeaders($headers)->postJson('/api/pipeline/orders', ['sku' => 'book'])->assertStatus(201);
        $this->withHeaders($headers)->postJson('/api/pipeline/orders', ['sku' => 'book'])->assertStatus(409);
    }
}
