<?php

namespace App\Http\Controllers\Shopper;

use App\Http\Controllers\Controller;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'Pending')->count();

        $inProgressOrders = Order::whereIn('status', [
            'Accepted',
            'Shopping in Progress',
            'Purchased',
            'Out for Delivery'
        ])->count();

        $completedOrders = Order::where('status', 'Completed')->count();
        $cancelledOrders = Order::where('status', 'Cancelled')->count();

        $latestOrders = Order::with('customer')
            ->latest()
            ->take(10)
            ->get();

        return view('shopper.dashboard', compact(
            'totalOrders',
            'pendingOrders',
            'inProgressOrders',
            'completedOrders',
            'cancelledOrders',
            'latestOrders'
        ));
    }
}
