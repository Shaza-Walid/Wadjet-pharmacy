<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Services\Order\OrderService;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    public function __construct(
        protected readonly OrderService $orderService
    ) {}

    public function store(StoreOrderRequest $request)
    {
        try {
            $this->orderService->createOrder($request->validated());
            if ($request->expectsJson()) {
                return response()->json(['success' => true]);
            }
            return redirect()->back()->with('success', 'Order placed successfully');
        } catch (ValidationException $e) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => $e->validator->errors()->first()], 422);
            }
            return redirect()->back()->withErrors($e->validator->errors());
        }
    }
}