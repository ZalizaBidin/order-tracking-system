<?php

namespace App\Imports;

use App\Models\Stock;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class StocksImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    public function model(array $row)
    {
        return new Stock([
            'item_name'   => $row['item_name'],
            'description' => $row['description'] ?? null,
            'price'       => $row['price'] ?? 0,
            'quantity'    => $row['quantity'] ?? 0,
            'status'      => $row['status'] ?? 'Available',
            'image'       => null,
        ]);
    }

    public function rules(): array
    {
        return [
            '*.item_name'   => ['required', 'string', 'max:255'],
            '*.description' => ['nullable', 'string'],
            '*.price'       => ['nullable', 'numeric', 'min:0'],
            '*.quantity'    => ['required', 'integer', 'min:0'],
            '*.status'      => ['nullable', 'in:Available,Unavailable'],
        ];
    }
}
