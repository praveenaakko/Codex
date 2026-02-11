<?php

declare(strict_types=1);

namespace Tests\Feature\Routing;

use Illuminate\Support\Facades\URL;
use Tests\TestCase;

final class RoutingTopologyTest extends TestCase
{
    public function test_it_builds_named_route_for_v2_post_show(): void
    {
        $url = route('api.v2.posts.show', ['post' => 'mastering-routing']);

        $this->assertStringEndsWith('/api/v2/posts/mastering-routing', $url);
    }

    public function test_it_generates_signed_invite_route(): void
    {
        $signed = URL::temporarySignedRoute(
            'invites.accept',
            now()->addMinutes(10),
            ['invite' => 'abc123']
        );

        $this->assertStringContainsString('signature=', $signed);
    }
}
