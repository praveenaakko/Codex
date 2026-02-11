<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Actions\Orders\PlaceOrderAction;
use App\DTO\PlaceOrderData;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class CreateOrderController
{
    public function __invoke(Request $request, PlaceOrderAction $action): JsonResponse
    {
        $validated = $request->validate([
            'customer_id' => ['required', 'integer', 'min:1'],
            'sku' => ['required', 'string', 'max:100'],
            'quantity' => ['required', 'integer', 'min:1'],
            'unit_price' => ['required', 'numeric', 'min:0.01'],
        ]);

        $data = new PlaceOrderData(
            customerId: (int) $validated['customer_id'],
            sku: (string) $validated['sku'],
            quantity: (int) $validated['quantity'],
            unitPrice: (float) $validated['unit_price'],
        );

        $order = $action->execute($data);

        return response()->json([
            'status' => 'created',
            'data' => $order,
        ], 201);
    }
}
