<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class PipelineOrderController
{
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json([
            'status' => 'accepted',
            'order_reference' => 'ORD-' . strtoupper((string) str()->random(8)),
            'payload' => $request->all(),
        ], 201);
    }
}
