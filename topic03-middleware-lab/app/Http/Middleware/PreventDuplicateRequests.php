<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

final class PreventDuplicateRequests
{
    public function handle(Request $request, Closure $next): mixed
    {
        $idempotencyKey = (string) $request->header('Idempotency-Key', '');

        if ($idempotencyKey === '') {
            return new JsonResponse(['message' => 'Idempotency-Key header is required.'], 422);
        }

        $cacheKey = sprintf('idem:%s:%s:%s', $request->method(), $request->path(), $idempotencyKey);

        if (! Cache::add($cacheKey, 'seen', now()->addMinutes(10))) {
            return new JsonResponse([
                'message' => 'Duplicate request detected for idempotency key.',
            ], 409);
        }

        return $next($request);
    }
}
