<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalRevenue = \App\Models\OrderItem::whereHas('order', function($q) {
            $q->where('status', '!=', 'cancelled');
        })->sum('subtotal');

        $stats = [
            'total_revenue' => $totalRevenue,
            'total_orders' => Order::count(),
            'total_customers' => Customer::count(),
            'low_stock_products' => Product::where('quantity', '<', 10)->count(),
        ];

        $recentOrders = Order::with('customer')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $lowStockItems = Product::where('quantity', '<', 10)
            ->take(5)
            ->get();

        return view('admin.dashboard.index', compact('stats', 'recentOrders', 'lowStockItems'));
    }
}
