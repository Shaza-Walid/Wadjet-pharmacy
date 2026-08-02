<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\UpdateOrderStatusRequest;
use App\Services\Order\OrderService;

class OrderController extends Controller
{
    public function __construct(
        protected readonly OrderService $orderService
    ) {}

    public function index()
    {
        $orders = $this->orderService->getAllOrders();
        return view('admin.orders.index', compact('orders'));
    }

    public function show(string $id)
    {
        $order = $this->orderService->getOrder($id);

        if (!$order) {
            return redirect()->back()->with('error', 'Order not found');
        }

        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(UpdateOrderStatusRequest $request, string $id)
    {
        $order = $this->orderService->updateOrderStatus($id, $request->validated());

        if (! $order) {
            return redirect()->back()->with('error', 'Order not found');
        }

        return redirect()->back()->with('success', 'Order status updated successfully');
    }
}