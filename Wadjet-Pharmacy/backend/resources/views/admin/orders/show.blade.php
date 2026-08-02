@extends('admin.layouts.admin')

@section('title', 'Order Details #' . ($order->order_id ?? $order->id))

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>Order Details</h2>
        <a href="{{ route('admin.orders.index') }}" class="btn" style="background: #6c757d;">Back to Orders</a>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
        <div>
            <h3>Customer Info</h3>
            <p><strong>Name:</strong> {{ $order->customer_name }}</p>
            <p><strong>Phone:</strong> {{ $order->phone }}</p>
            <p><strong>Address:</strong> {{ $order->address }}</p>
            <p><strong>Notes:</strong> {{ $order->notes ?: 'No notes provided' }}</p>
        </div>
        <div>
            <h3>Order Status</h3>
            <p><strong>Status:</strong> <span class="badge badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span></p>
            <p><strong>Created At:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
            
            <form action="{{ route('admin.orders.updateStatus', $order->order_id ?? $order->id) }}" method="POST" style="margin-top: 15px;">
                @csrf
                @method('PUT')
                <select name="status" style="padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                <button type="submit" class="btn">Update Status</button>
            </form>
        </div>
    </div>

    <h3>Order Items</h3>
    <table>
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @forelse($order->items ?? [] as $item)
                @php $total += $item->subtotal; @endphp
                <tr>
                    <td>#{{ $item->product_id }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->unit_price, 2) }}</td>
                    <td>${{ number_format($item->subtotal, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center;">No items found.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" style="text-align: right;">Total:</th>
                <th>${{ number_format($total, 2) }}</th>
            </tr>
        </tfoot>
    </table>
</div>
@endsection
