<?php

namespace App\Exports;

use App\Models\Sales;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalesExport implements FromCollection, WithHeadings
{
    protected $salesData;

    public function __construct($salesData)
    {
        $this->salesData = $salesData;
    }

    public function collection()
    {
        return $this->salesData->map(function ($sale, $index) {
            return [
                $index + 1,
                $sale->user->name,
                $sale->nama_pelanggan,
                $sale->alamat,
                $sale->nomor_whatsapp,
                $sale->paket->nama,
            ];
        });
    }

    public function headings(): array
    {
        return [
            '#',
            'Sales',
            'Nama Pelanggan',
            'Alamat',
            'Nomor WhatsApp',
            'Paket',
        ];
    }
}
