<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V2;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class PostController
{
    public function index(): JsonResponse
    {
        return response()->json([
            'version' => 'v2',
            'meta' => [
                'contract' => 'posts.v2',
                'supports_cursor' => true,
            ],
            'data' => Post::query()->latest()->cursorPaginate(15),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'slug' => ['required', 'string', 'max:120', 'unique:posts,slug'],
            'body' => ['required', 'string'],
            'status' => ['required', 'in:draft,published'],
        ]);

        $post = Post::query()->create($validated);

        return response()->json(['version' => 'v2', 'data' => $post], 201);
    }

    public function show(Post $post): JsonResponse
    {
        return response()->json(['version' => 'v2', 'data' => $post]);
    }

    public function update(Request $request, Post $post): JsonResponse
    {
        $post->update($request->validate([
            'title' => ['sometimes', 'string', 'max:120'],
            'body' => ['sometimes', 'string'],
            'status' => ['sometimes', 'in:draft,published'],
        ]));

        return response()->json(['version' => 'v2', 'data' => $post->fresh()]);
    }

    public function destroy(Post $post): JsonResponse
    {
        $post->delete();

        return response()->json([], 204);
    }
}
