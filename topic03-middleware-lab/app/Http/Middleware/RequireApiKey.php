<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class RequireApiKey
{
    public function handle(Request $request, Closure $next): mixed
    {
        $provided = (string) $request->header('X-Api-Key', '');
        $expected = (string) config('services.pipeline.api_key', 'local-dev-key');

        if ($provided === '' || ! hash_equals($expected, $provided)) {
            return new JsonResponse([
                'message' => 'Invalid API key.',
            ], 401);
        }

        return $next($request);
    }
}
