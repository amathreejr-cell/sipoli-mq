<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StokObatExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(
        private Collection $laporan
    ) {}

    public function collection(): Collection
    {
        return $this->laporan;
    }

    public function headings(): array
    {
        return [
            'Kode Obat',
            'Nama Obat',
            'Bentuk',
            'Satuan',
            'Stok Lama',
            'Stok Baru / Masuk',
            'Jumlah Stok',
            'Terpakai Putra',
            'Terpakai Putri',
            'Keluar Lainnya',
            'Total Keluar',
            'Sisa Obat',
            'Stok Saat Ini',
        ];
    }

    public function map($item): array
    {
        return [
            $item['kode'],
            $item['nama'],
            $item['bentuk'],
            $item['satuan'],
            $item['stok_awal'],
            $item['stok_masuk'],
            $item['jumlah_stok'],
            $item['terpakai_putra'],
            $item['terpakai_putri'],
            $item['keluar_lainnya'],
            $item['total_keluar'],
            $item['sisa_stok'],
            $item['stok_saat_ini'],
        ];
    }
}
