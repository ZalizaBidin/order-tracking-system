<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Stock;
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

    public function stocks()
    {
        $stocks = Stock::where('status', 'Available')
            ->where('quantity', '>', 0)
            ->latest()
            ->paginate(12);

        return view('customer.orders.stocks', compact('stocks'));
    }

    public function orderFromStock(Request $request, Stock $stock)
    {
        $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
            'delivery_address' => ['nullable', 'string', 'max:1000'],
            'latitude' => ['nullable', 'numeric'],
            'longitude' => ['nullable', 'numeric'],
            'remarks' => ['nullable', 'string'],
        ]);

        if ($stock->status !== 'Available' || $stock->quantity < $request->quantity) {
            return back()->with('error', 'Stock is not available or quantity is insufficient.');
        }

        $order = Order::create([
            'stock_id' => $stock->id,
            'order_no' => 'ORD-' . now()->format('YmdHis') . '-' . strtoupper(Str::random(4)),
            'customer_id' => auth()->id(),
            'item_name' => $stock->item_name,
            'item_description' => $stock->description,
            'quantity' => $request->quantity,
            'estimated_budget' => $stock->price ? $stock->price * $request->quantity : null,
            'delivery_address' => $request->delivery_address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'status' => 'Pending',
            'remarks' => $request->remarks,
        ]);

        $stock->decrement('quantity', $request->quantity);

        if ($stock->fresh()->quantity <= 0) {
            $stock->update([
                'status' => 'Unavailable',
            ]);
        }

        OrderStatusLog::create([
            'order_id' => $order->id,
            'status' => 'Pending',
            'remarks' => 'Order created by customer from stock item.',
            'updated_by' => auth()->id(),
        ]);

        return redirect()
            ->route('customer.orders.show', ['order' => encrypt($order->id)])
            ->with('success', 'Order created successfully.');
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
        $stocks = Stock::where('status', 'Available')
            ->where('quantity', '>', 0)
            ->orderBy('item_name')
            ->get();

        return view('customer.orders.create', compact('stocks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'stock_id' => ['required', 'exists:stocks,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'remarks' => ['nullable', 'string'],
            'delivery_address' => ['nullable', 'string', 'max:1000'],
            'latitude' => ['nullable', 'numeric'],
            'longitude' => ['nullable', 'numeric'],
        ]);

        $stock = Stock::findOrFail($request->stock_id);

        if ($stock->status !== 'Available' || $stock->quantity < $request->quantity) {
            return back()
                ->withInput()
                ->with('error', 'Stock is not available or quantity is insufficient.');
        }

        $order = Order::create([
            'stock_id' => $stock->id,
            'order_no' => 'ORD-' . now()->format('YmdHis') . '-' . strtoupper(Str::random(4)),
            'customer_id' => auth()->id(),
            'item_name' => $stock->item_name,
            'item_description' => $stock->description,
            'quantity' => $request->quantity,
            'estimated_budget' => $stock->price ? $stock->price * $request->quantity : 0,
            'delivery_address' => $request->delivery_address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'status' => 'Pending',
            'remarks' => $request->remarks,
        ]);

        $stock->decrement('quantity', $request->quantity);

        if ($stock->fresh()->quantity <= 0) {
            $stock->update([
                'status' => 'Unavailable',
            ]);
        }

        OrderStatusLog::create([
            'order_id' => $order->id,
            'status' => 'Pending',
            'remarks' => 'Order created by customer from stock.',
            'updated_by' => auth()->id(),
        ]);

        return redirect()
            ->route('customer.orders.show', ['order' => encrypt($order->id)])
            ->with('success', 'Order created successfully.');
    }

    public function show($order)
    {
        try {
            $orderId = decrypt($order);
        } catch (DecryptException $e) {
            abort(404);
        }

        $order = Order::with(['logs.updatedBy', 'shopper'])
            ->where('customer_id', auth()->id())
            ->findOrFail($orderId);

        return view('customer.orders.show', compact('order'));
    }
}
