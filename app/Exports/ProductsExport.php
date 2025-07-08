<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        return Product::with(['category', 'brand'])->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Code',
            'Category',
            'Brand',
            'Price',
            'Quantity',
            'Total Value',
            'Description',
        ];
    }

    public function map($product): array
    {
        return [
            $product->id,
            $product->name,
            $product->code,
            $product->category->name,
            $product->brand->name,
            number_format($product->price, 2),
            $product->quantity,
            number_format($product->price * $product->quantity, 2),
            $product->description,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text
            1 => ['font' => ['bold' => true]],
            
            // Styling specific cells
            'A' => ['alignment' => ['horizontal' => 'center']],
            'F:H' => ['alignment' => ['horizontal' => 'right']],
        ];
    }
}