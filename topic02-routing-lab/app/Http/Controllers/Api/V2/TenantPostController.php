<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V2;

use App\Models\Post;
use Illuminate\Http\JsonResponse;

final class TenantPostController
{
    public function index(string $tenant): JsonResponse
    {
        return response()->json([
            'tenant' => $tenant,
            'data' => Post::query()
                ->where('tenant_slug', $tenant)
                ->latest()
                ->paginate(15),
        ]);
    }

    public function show(string $tenant, Post $post): JsonResponse
    {
        abort_if($post->tenant_slug !== $tenant, 404, 'Post does not belong to tenant.');

        return response()->json([
            'tenant' => $tenant,
            'data' => $post,
        ]);
    }
}
