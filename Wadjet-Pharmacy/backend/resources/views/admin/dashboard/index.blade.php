@extends('admin.layouts.admin')

@section('title', 'Dashboard Overview')

@section('styles')
<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .stat-card {
        background: var(--white);
        border-radius: 12px;
        padding: 25px;
        display: flex;
        align-items: center;
        gap: 20px;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
        border: 1px solid var(--border);
        transition: transform 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        flex-shrink: 0;
    }

    .icon-blue { background: #e0f2fe; color: #0284c7; }
    .icon-green { background: #d1fae5; color: #059669; }
    .icon-purple { background: #fae8ff; color: #c026d3; }
    .icon-red { background: #fee2e2; color: #dc2626; }

    .stat-details h3 {
        font-size: 14px;
        color: var(--text-light);
        text-transform: uppercase;
        margin-bottom: 5px;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .stat-details p {
        font-size: 28px;
        font-weight: 800;
        color: var(--text-dark);
        margin: 0;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 25px;
    }

    @media (max-width: 1024px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
        }
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: var(--text-light);
    }
    
    .empty-state svg {
        margin-bottom: 15px;
        color: #cbd5e1;
    }
</style>
@endsection

@section('content')

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon icon-green">
                <svg viewBox="0 0 24 24" width="30" height="30" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
            </div>
            <div class="stat-details">
                <h3>Total Revenue</h3>
                <p>{{ number_format($stats['total_revenue'], 2) }} EGP</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon icon-blue">
                <svg viewBox="0 0 24 24" width="30" height="30" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
            </div>
            <div class="stat-details">
                <h3>Total Orders</h3>
                <p>{{ $stats['total_orders'] }}</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon icon-purple">
                <svg viewBox="0 0 24 24" width="30" height="30" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
            </div>
            <div class="stat-details">
                <h3>Customers</h3>
                <p>{{ $stats['total_customers'] }}</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon icon-red">
                <svg viewBox="0 0 24 24" width="30" height="30" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
            </div>
            <div class="stat-details">
                <h3>Low Stock</h3>
                <p>{{ $stats['low_stock_products'] }}</p>
            </div>
        </div>
    </div>

    <!-- Main Grid -->
    <div class="dashboard-grid">
        
        <!-- Recent Orders -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Recent Orders</h2>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-primary btn-sm">View All</a>
            </div>
            
            @if($recentOrders->count() > 0)
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentOrders as $order)
                                <tr>
                                    <td><strong>#{{ $order->order_id }}</strong></td>
                                    <td>{{ $order->customer_name }}</td>
                                    <td>{{ $order->created_at->format('M d, Y h:i A') }}</td>
                                    <td>
                                        <span class="badge badge-{{ $order->status }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <svg viewBox="0 0 24 24" width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                    <p>No orders received yet.</p>
                </div>
            @endif
        </div>

        <!-- Low Stock Alerts -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Low Stock Alerts</h2>
                <a href="{{ route('admin.products.index') }}" class="btn btn-primary btn-sm">Manage</a>
            </div>
            
            @if($lowStockItems->count() > 0)
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lowStockItems as $item)
                                <tr>
                                    <td>
                                        <div style="font-weight: 600; color: var(--text-dark);">{{ Str::limit($item->name, 25) }}</div>
                                    </td>
                                    <td>
                                        <span class="badge badge-cancelled">{{ $item->quantity }} Left</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <svg viewBox="0 0 24 24" width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    <p>All products are well stocked.</p>
                </div>
            @endif
        </div>
        
    </div>
@endsection
