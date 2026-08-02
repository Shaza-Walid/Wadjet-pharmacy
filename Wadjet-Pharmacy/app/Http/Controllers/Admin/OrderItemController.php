<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\OrderItem\StoreOrderItemRequest;
use App\Http\Requests\OrderItem\UpdateOrderItemRequest;
use App\Services\OrderItem\OrderItemService;

class OrderItemController extends Controller
{
    public function __construct(
        protected readonly OrderItemService $orderItemService
    ) {}

    public function index()
    {
        $orderItems = $this->orderItemService->getAllOrderItems();

        return view('admin.'.strtolower(class_basename($this)).'.view', compact('orderItems')); // Refactored placeholder
    }

    public function store(StoreOrderItemRequest $request)
    {
        $this->orderItemService->createOrderItem($request->validated());

        return redirect()->back()->with('success', 'Order item created successfully');
    }

    public function show(string $id)
    {
        $orderItem = $this->orderItemService->getOrderItem($id);

        if (!$orderItem) {
            return redirect()->back()->with('error', 'Order item not found');
        }

        return view('admin.'.strtolower(class_basename($this)).'.view', compact('orderItem')); // Refactored placeholder
    }

    public function update(UpdateOrderItemRequest $request, string $id)
    {
        $orderItem = $this->orderItemService->updateOrderItem($id, $request->validated());

        if (!$orderItem) {
            return redirect()->back()->with('error', 'Order item not found');
        }

        return redirect()->back()->with('success', 'Order item updated successfully');
    }

    public function destroy(string $id)
    {
        $deleted = $this->orderItemService->deleteOrderItem($id);

        if (!$deleted) {
            return redirect()->back()->with('error', 'Order item not found');
        }

        return redirect()->back()->with('success', 'Order item deleted successfully');
    }
}