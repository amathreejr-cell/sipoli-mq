<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DaftarHapusSantriImport implements ToCollection, WithHeadingRow
{
    public array $nomorInduk = [];

    public function collection(Collection $rows): void
    {
        foreach ($rows as $row) {
            $nomorInduk = trim((string) ($row['nomor_induk'] ?? ''));

            if ($nomorInduk !== '') {
                $this->nomorInduk[] = $nomorInduk;
            }
        }

        $this->nomorInduk = array_values(
            array_unique($this->nomorInduk)
        );
    }
}
