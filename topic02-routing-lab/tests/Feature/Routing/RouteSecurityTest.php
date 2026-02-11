<?php

declare(strict_types=1);

namespace Tests\Feature\Routing;

use Tests\TestCase;

final class RouteSecurityTest extends TestCase
{
    public function test_internal_route_health_requires_authentication(): void
    {
        $this->get('/internal/route-health')->assertRedirect('/login');
    }

    public function test_unknown_tenant_subdomain_is_rejected(): void
    {
        $this->withServerVariables(['HTTP_HOST' => 'invalid_#.example.test'])
            ->getJson('/api/v2/posts')
            ->assertStatus(404);
    }
}
