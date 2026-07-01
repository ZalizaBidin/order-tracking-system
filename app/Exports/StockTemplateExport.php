<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StockTemplateExport implements FromArray, WithHeadings, ShouldAutoSize, WithStyles
{
    public function headings(): array
    {
        return [
            'item_name',
            'description',
            'price',
            'quantity',
            'status',
        ];
    }

    public function array(): array
    {
        return [
            [
                'Burger Ayam',
                'Burger biasa',
                5.50,
                20,
                'Available',
            ],
            [
                'Nasi Lemak',
                'With sambal',
                3.00,
                50,
                'Available',
            ],
            [
                'Air Mineral',
                '500ml bottle',
                1.20,
                100,
                'Unavailable',
            ],
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                ],
            ],
        ];
    }
}
