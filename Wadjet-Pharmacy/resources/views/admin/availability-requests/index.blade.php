@extends('admin.layouts.admin')

@section('title', 'Availability Requests')

@section('content')

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Customer Availability Requests</h2>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Phone</th>
                    <th>Product Request</th>
                    <th>Status</th>
                    <th>Submitted At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($requests as $request)
                <tr>
                    <td><strong>#{{ $request->request_id }}</strong></td>
                    <td>
                        <div style="font-weight: 600; font-size: 15px;">{{ $request->customer_name }}</div>
                    </td>
                    <td>
                        {{ $request->customer_phone }}
                    </td>
                    <td>
                        {{ Str::limit($request->product_name, 30) }}
                    </td>
                    <td>
                        @if($request->status == 'pending')
                            <span class="badge badge-pending">Pending</span>
                        @elseif($request->status == 'fulfilled')
                            <span class="badge badge-delivered">Fulfilled</span>
                        @elseif($request->status == 'cancelled')
                            <span class="badge badge-cancelled">Cancelled</span>
                        @else
                            <span class="badge badge-active">{{ ucfirst($request->status) }}</span>
                        @endif
                    </td>
                    <td>
                        {{ $request->created_at ? $request->created_at->format('M d, Y h:i A') : 'N/A' }}
                    </td>
                    <td>
                        <div style="display: flex; gap: 8px;">
                            <form action="{{ route('admin.availability-requests.updateStatus', $request->request_id) }}" method="POST" style="margin:0;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="fulfilled">
                                <button type="submit" class="btn btn-success btn-sm" style="background: #10b981; color: white;" @if($request->status == 'fulfilled') disabled @endif>Fulfill</button>
                            </form>
                            
                            <form action="{{ route('admin.availability-requests.updateStatus', $request->request_id) }}" method="POST" style="margin:0;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="cancelled">
                                <button type="submit" class="btn btn-warning btn-sm" style="color: white; background-color: #f59e0b; border-color: #f59e0b;" @if($request->status == 'cancelled') disabled @endif>Cancel</button>
                            </form>

                            <form action="{{ route('admin.availability-requests.destroy', $request->request_id) }}" method="POST" style="margin:0;" onsubmit="return confirm('Are you sure you want to delete this request?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 30px; color: var(--text-light);">
                        No availability requests found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
