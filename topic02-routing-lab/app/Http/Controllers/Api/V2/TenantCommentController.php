<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V2;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class TenantCommentController
{
    public function index(string $tenant, Post $post): JsonResponse
    {
        abort_if($post->tenant_slug !== $tenant, 404, 'Post does not belong to tenant.');

        return response()->json([
            'tenant' => $tenant,
            'post' => $post->slug,
            'data' => $post->comments()->latest()->get(),
        ]);
    }

    public function store(Request $request, string $tenant, Post $post): JsonResponse
    {
        abort_if($post->tenant_slug !== $tenant, 404, 'Post does not belong to tenant.');

        $comment = $post->comments()->create($request->validate([
            'body' => ['required', 'string', 'max:1000'],
        ]));

        return response()->json([
            'tenant' => $tenant,
            'data' => $comment,
        ], 201);
    }
}
