<?php

namespace App\Http\Controllers\Shopper;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::latest()->paginate(10);

        return view('shopper.stocks.index', compact('stocks'));
    }

    public function create()
    {
        return view('shopper.stocks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'quantity' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'status' => ['required', 'in:Available,Unavailable'],
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('stocks', 'public');
        }

        Stock::create([
            'item_name' => $request->item_name,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'image' => $imagePath,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('shopper.stocks.index')
            ->with('success', 'Stock item created successfully.');
    }

    public function edit(Stock $stock)
    {
        return view('shopper.stocks.edit', compact('stock'));
    }

    public function update(Request $request, Stock $stock)
    {
        $request->validate([
            'item_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'quantity' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'status' => ['required', 'in:Available,Unavailable'],
        ]);

        $imagePath = $stock->image;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('stocks', 'public');
        }

        $stock->update([
            'item_name' => $request->item_name,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'image' => $imagePath,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('shopper.stocks.index')
            ->with('success', 'Stock updated successfully.');
    }

    public function destroy(Stock $stock)
    {
        $stock->delete();

        return redirect()
            ->route('shopper.stocks.index')
            ->with('success', 'Stock deleted successfully.');
    }

   
}
