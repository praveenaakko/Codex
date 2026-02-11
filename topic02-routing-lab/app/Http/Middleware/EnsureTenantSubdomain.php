<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class EnsureTenantSubdomain
{
    public function handle(Request $request, Closure $next): Response
    {
        $tenant = (string) $request->route('tenant', '');

        if (! preg_match('/^[a-z0-9-]+$/', $tenant)) {
            abort(404, 'Invalid tenant identifier.');
        }

        return $next($request);
    }
}
