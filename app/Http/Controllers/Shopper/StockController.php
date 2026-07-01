<?php

namespace App\Http\Controllers\Shopper;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use App\Imports\StocksImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StockTemplateExport;

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
            'item_name'   => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price'       => ['nullable', 'numeric', 'min:0'],
            'quantity'    => ['required', 'integer', 'min:0'],
            'status'      => ['required', 'in:Available,Unavailable'],
            'image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('stocks', 'public');
        }

        Stock::create([
            'item_name'   => $request->item_name,
            'description' => $request->description,
            'price'       => $request->price ?? 0,
            'quantity'    => $request->quantity,
            'status'      => $request->status,
            'image'       => $imagePath,
        ]);

        return redirect()
            ->route('shopper.stocks.index')
            ->with('success', 'Stock created successfully.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => ['required', 'file', 'mimes:xlsx,xls,csv', 'max:5120'],
        ]);

        try {
            Excel::import(new StocksImport, $request->file('excel_file'));

            return redirect()
                ->route('shopper.stocks.index')
                ->with('success', 'Stocks imported successfully.');
        } catch (\Throwable $e) {
            return back()
                ->withInput()
                ->with('error', 'Failed to import Excel file. Please check your file format and data.');
        }
    }

    public function downloadTemplate()
    {
        return Excel::download(new StockTemplateExport, 'stock_import_template.xlsx');
    }
}
