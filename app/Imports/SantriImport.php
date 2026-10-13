<?php

namespace App\Imports;

use App\Models\Santri;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SantriImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows): void
    {
        /*
        |--------------------------------------------------------------------------
        | Bersihkan baris kosong
        |--------------------------------------------------------------------------
        */

        $rows = $rows->filter(function ($row) {
            return collect($row)->filter(function ($value) {
                return $value !== null && $value !== '';
            })->isNotEmpty();
        })->values();

        if ($rows->isEmpty()) {
            throw ValidationException::withMessages([
                'file' => 'File Excel tidak memiliki data santri.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Cek nomor induk duplikat di dalam file Excel
        |--------------------------------------------------------------------------
        */

        $nomorInduk = [];

        foreach ($rows as $index => $row) {
            $nomor = trim((string) ($row['nomor_induk'] ?? ''));

            if ($nomor !== '') {
                if (in_array($nomor, $nomorInduk, true)) {
                    throw ValidationException::withMessages([
                        'file' => "Nomor induk {$nomor} muncul lebih dari satu kali pada file Excel (baris " . ($index + 2) . ").",
                    ]);
                }

                $nomorInduk[] = $nomor;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Cek nomor induk yang sudah ada di database
        |--------------------------------------------------------------------------
        */

        $existingNomorInduk = Santri::whereIn('nomor_induk', $nomorInduk)
            ->pluck('nomor_induk')
            ->toArray();

        if (!empty($existingNomorInduk)) {
            throw ValidationException::withMessages([
                'file' => 'Nomor induk berikut sudah terdaftar: '
                    . implode(', ', $existingNomorInduk),
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Validasi seluruh data sebelum disimpan
        |--------------------------------------------------------------------------
        */

        $data = [];

        foreach ($rows as $index => $row) {

            $excelRow = $index + 2;

            $tanggalLahir = $row['tanggal_lahir'] ?? null;

            /*
            |--------------------------------------------------------------------------
            | Konversi tanggal Excel
            |--------------------------------------------------------------------------
            */

            if ($tanggalLahir !== null && $tanggalLahir !== '') {
                try {
                    if (is_numeric($tanggalLahir)) {
                        $tanggalLahir = Carbon::instance(
                            \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(
                                $tanggalLahir
                            )
                        )->format('Y-m-d');
                    } else {
                        $tanggalLahir = Carbon::parse($tanggalLahir)->format('Y-m-d');
                    }
                } catch (\Throwable $e) {
                    throw ValidationException::withMessages([
                        'file' => "Tanggal lahir pada baris {$excelRow} tidak valid.",
                    ]);
                }
            }

            $rowData = [
                'nomor_induk' => trim((string) ($row['nomor_induk'] ?? '')),
                'nama' => trim((string) ($row['nama'] ?? '')),
                'tempat_lahir' => $this->nullableString($row['tempat_lahir'] ?? null),
                'jenis_kelamin' => strtoupper(trim((string) ($row['jenis_kelamin'] ?? ''))),
                'tanggal_lahir' => $tanggalLahir,
                'kamar' => $this->nullableString($row['kamar'] ?? null),
                'sekolah' => $this->nullableString($row['sekolah'] ?? null),
                'kelas' => $this->nullableString($row['kelas'] ?? null),
                'alamat' => $this->nullableString($row['alamat'] ?? null),
                'status' => strtolower(trim((string) ($row['status'] ?? ''))),
            ];

            /*
            |--------------------------------------------------------------------------
            | Validasi mengikuti SantriController
            |--------------------------------------------------------------------------
            */

            $validator = Validator::make(
                $rowData,
                [
                    'nomor_induk' => [
                        'required',
                        'string',
                        'max:50',
                    ],
                    'nama' => [
                        'required',
                        'string',
                        'max:150',
                    ],
                    'tempat_lahir' => [
                        'nullable',
                        'string',
                        'max:100',
                    ],
                    'jenis_kelamin' => [
                        'required',
                        'in:L,P',
                    ],
                    'tanggal_lahir' => [
                        'nullable',
                        'date',
                    ],
                    'kamar' => [
                        'nullable',
                        'string',
                        'max:50',
                    ],
                    'sekolah' => [
                        'nullable',
                        'string',
                        'max:150',
                    ],
                    'kelas' => [
                        'nullable',
                        'string',
                        'max:50',
                    ],
                    'alamat' => [
                        'nullable',
                        'string',
                    ],
                    'status' => [
                        'required',
                        'in:aktif,nonaktif',
                    ],
                ]
            );

            if ($validator->fails()) {
                $errors = $validator->errors()->all();

                throw ValidationException::withMessages([
                    'file' => 'Kesalahan pada baris '
                        . $excelRow
                        . ': '
                        . implode(' ', $errors),
                ]);
            }

            $data[] = $rowData;
        }

        /*
        |--------------------------------------------------------------------------
        | Simpan seluruh data dalam satu transaksi
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use ($data) {
            foreach ($data as $santri) {
                Santri::create($santri);
            }
        });
    }

    /**
     * Mengubah nilai kosong menjadi null.
     */
    private function nullableString(mixed $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $value = trim((string) $value);

        return $value === '' ? null : $value;
    }
}