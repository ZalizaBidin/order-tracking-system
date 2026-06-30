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

    public function show($id)
    {
        $orderId = decrypt($id);
        $order = Order::with(['customer', 'shopper', 'logs.updatedBy'])->findOrFail($orderId);

        return view('shopper.orders.show', compact('order'));
    }

    public function create()
    {
        return view('shopper.orders.create');
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
            'status' => 'In Stock',
        ]);

        OrderStatusLog::create([
            'order_id' => $order->id,
            'status' => 'In Stock',
            'updated_by' => auth()->id(),
        ]);

        return redirect()
            ->route('shopper.orders.show', ['order' => encrypt($order->id)])
            ->with('success', 'Stock created successfully.');
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => ['required', 'string'],
            'remarks' => ['nullable', 'string'],
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
