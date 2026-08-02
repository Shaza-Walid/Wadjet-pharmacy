@extends('admin.layouts.admin')

@section('title', 'Customers Management')

@section('content')

<div class="card">
    <div class="card-header">
        <h2 class="card-title">All Customers</h2>
        <!-- Future: Add Customer Modal -->
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Contact Info</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($customers as $customer)
                <tr>
                    <td><strong>#{{ $customer->customer_id }}</strong></td>
                    <td>
                        <div style="font-weight: 600; font-size: 15px;">{{ $customer->name }}</div>
                    </td>
                    <td>
                        <div style="color: var(--text-light); font-size: 13px;">
                            Email: {{ $customer->email }}<br>
                            Phone: {{ $customer->phone ?? 'N/A' }}
                        </div>
                    </td>
                    <td>
                        <div style="font-size: 13px;">{{ Str::limit($customer->address, 30) }}</div>
                    </td>
                    <td>
                        <div style="display: flex; gap: 8px;">
                            <form action="{{ route('admin.customers.destroy', $customer->customer_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this customer?');" style="margin:0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 30px; color: var(--text-light);">
                        No customers registered yet.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
