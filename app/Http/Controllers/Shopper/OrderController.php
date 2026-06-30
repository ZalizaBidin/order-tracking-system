<?php

namespace App\Http\Controllers\Shopper;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatusLog;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['customer', 'shopper'])
            ->latest()
            ->paginate(10);

        return view('shopper.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order = decrypt($order);
        $order->load(['customer', 'shopper', 'logs.updatedBy']);

        return view('shopper.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => ['required', 'string'],
            'remarks' => ['nullable', 'string'],
            'latitude' => ['nullable', 'numeric'],
            'longitude' => ['nullable', 'numeric'],
        ]);

        $allowedStatuses = [
            'Pending',
            'Accepted',
            'Shopping in Progress',
            'Purchased',
            'Out for Delivery',
            'Completed',
            'Cancelled',
        ];

        if (!in_array($request->status, $allowedStatuses)) {
            return back()->with('error', 'Invalid order status.');
        }

        $order->update([
            'status' => $request->status,
            'shopper_id' => auth()->id(),
            'remarks' => $request->remarks,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        OrderStatusLog::create([
            'order_id' => $order->id,
            'status' => $request->status,
            'remarks' => $request->remarks,
            'updated_by' => auth()->id(),
        ]);

        return back()->with('success', 'Order status updated successfully.');
    }
}
