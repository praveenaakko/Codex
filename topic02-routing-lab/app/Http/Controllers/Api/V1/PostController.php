<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class PostController
{
    public function index(): JsonResponse
    {
        return response()->json([
            'version' => 'v1',
            'data' => Post::query()->latest()->paginate(15),
            'deprecated' => true,
            'sunset_at' => '2027-01-01T00:00:00Z',
        ])->header('Deprecation', 'true')
          ->header('Sunset', 'Wed, 01 Jan 2027 00:00:00 GMT');
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'slug' => ['required', 'string', 'max:120', 'unique:posts,slug'],
            'body' => ['required', 'string'],
        ]);

        $post = Post::query()->create($validated);

        return response()->json(['version' => 'v1', 'data' => $post], 201);
    }

    public function show(Post $post): JsonResponse
    {
        return response()->json(['version' => 'v1', 'data' => $post]);
    }

    public function update(Request $request, Post $post): JsonResponse
    {
        $post->update($request->validate([
            'title' => ['sometimes', 'string', 'max:120'],
            'body' => ['sometimes', 'string'],
        ]));

        return response()->json(['version' => 'v1', 'data' => $post->fresh()]);
    }

    public function destroy(Post $post): JsonResponse
    {
        $post->delete();

        return response()->json([], 204);
    }
}
