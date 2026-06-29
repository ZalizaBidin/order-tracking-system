<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatusLog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function dashboard()
    {
        $userId = auth()->id();

        $totalOrders = Order::where('customer_id', $userId)->count();
        $pendingOrders = Order::where('customer_id', $userId)->where('status', 'Pending')->count();
        $inProgressOrders = Order::where('customer_id', $userId)
            ->whereIn('status', ['Accepted', 'Shopping in Progress', 'Purchased', 'Out for Delivery'])
            ->count();
        $completedOrders = Order::where('customer_id', $userId)->where('status', 'Completed')->count();

        $orders = Order::where('customer_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        return view('customer.dashboard', compact(
            'totalOrders',
            'pendingOrders',
            'inProgressOrders',
            'completedOrders',
            'orders'
        ));
    }

    public function index()
    {
        $orders = Order::where('customer_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('customer.orders.index', compact('orders'));
    }

    public function create()
    {
        return view('customer.orders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_name' => ['required', 'string', 'max:255'],
            'item_description' => ['nullable', 'string'],
            'quantity' => ['required', 'integer', 'min:1'],
            'estimated_budget' => ['nullable', 'numeric', 'min:0'],
            'remarks' => ['nullable', 'string'],
        ]);

        $order = Order::create([
            'order_no' => 'ORD-' . now()->format('YmdHis') . '-' . strtoupper(Str::random(4)),
            'customer_id' => auth()->id(),
            'item_name' => $request->item_name,
            'item_description' => $request->item_description,
            'quantity' => $request->quantity,
            'estimated_budget' => $request->estimated_budget,
            'status' => 'Pending',
            'remarks' => $request->remarks,
        ]);

        OrderStatusLog::create([
            'order_id' => $order->id,
            'status' => 'Pending',
            'remarks' => 'Order created by customer.',
            'updated_by' => auth()->id(),
        ]);

        return redirect()
            ->route('customer.orders.show', $order)
            ->with('success', 'Order created successfully.');
    }

    public function show(Order $order)
    {
        if ($order->customer_id !== auth()->id()) {
            abort(403);
        }

        $order->load(['logs.updatedBy', 'shopper']);

        return view('customer.orders.show', compact('order'));
    }
}
