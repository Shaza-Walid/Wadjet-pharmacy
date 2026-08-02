@extends('admin.layouts.admin')

@section('title', 'Manage Orders')

@section('content')
<div class="card">
    <h2>All Orders</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>#{{ $order->order_id ?? $order->id }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>
                        <span class="badge badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
                    </td>
                    <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                    <td>
                        <!-- You can add a link to view order details here -->
                        <a href="{{ route('admin.orders.show', $order->order_id ?? $order->id) }}" class="btn">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">No orders found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
