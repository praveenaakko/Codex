<?php

declare(strict_types=1);

namespace Tests\Feature\Routing;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

final class RouteCacheReadinessTest extends TestCase
{
    public function test_route_cache_command_succeeds(): void
    {
        $this->assertSame(0, Artisan::call('route:cache'));

        Artisan::call('route:clear');
    }
}
