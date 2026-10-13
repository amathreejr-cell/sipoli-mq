<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Imports\SantriImport;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class SantriController extends Controller
{
    /**
     * Menampilkan daftar santri.
     */
    public function index(Request $request): View
    {
        $query = Santri::query();

        // Pencarian berdasarkan nomor induk atau nama
        if ($request->filled('search')) {
            $search = $request->string('search')->toString();

            $query->where(function ($q) use ($search) {
                $q->where('nomor_induk', 'like', "%{$search}%")
                    ->orWhere('nama', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->string('status')->toString());
        }

        $santris = $query
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();

        return view('santri.index', compact('santris'));
    }

    public function search(Request $request)
    {
        $keyword = $request->string('q')->toString();

        if ($keyword === '') {
            return response()->json([]);
        }

        $santris = Santri::query()
            ->where('status', 'aktif')
            ->where(function ($query) use ($keyword) {
                $query->where('nama', 'like', "%{$keyword}%")
                    ->orWhere('nomor_induk', 'like', "%{$keyword}%");
            })
            ->orderBy('nama')
            ->limit(10)
            ->get([
                'id',
                'nomor_induk',
                'nama',
                'tempat_lahir',
                'tanggal_lahir',
                'jenis_kelamin',
                'kamar',
                'sekolah',
                'kelas',
                'status',
            ]);

        return response()->json($santris);
    }

    public function data(Santri $santri)
    {
        return response()->json([
            'id' => $santri->id,
            'nomor_induk' => $santri->nomor_induk,
            'nama' => $santri->nama,
            'tempat_lahir' => $santri->tempat_lahir,
            'tanggal_lahir' => $santri->tanggal_lahir?->format('Y-m-d'),
            'jenis_kelamin' => $santri->jenis_kelamin,
            'kamar' => $santri->kamar,
            'sekolah' => $santri->sekolah,
            'kelas' => $santri->kelas,
            'status' => $santri->status,
        ]);
    }

    /**
     * Menampilkan form tambah santri.
     */
    public function create(): View
    {
        return view('santri.create');
    }

    /**
     * Menampilkan form import Excel.
     */
    public function importForm(): View
    {
        return view('santri.import');
    }

    /**
     * Import data santri dari Excel.
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => [
                'required',
                'file',
                'mimes:xlsx',
                'max:5120',
            ],
        ], [
            'file.required' => 'Silakan pilih file Excel.',
            'file.file' => 'File yang diunggah tidak valid.',
            'file.mimes' => 'File harus berformat .xlsx.',
            'file.max' => 'Ukuran file maksimal 5 MB.',
        ]);

        try {
            Excel::import(
                new SantriImport,
                $request->file('file')
            );

            return redirect()
                ->route('santri.index')
                ->with(
                    'success',
                    'Data santri berhasil diimport dari Excel.'
                );
        } catch (\Illuminate\Validation\ValidationException $e) {

            return redirect()
                ->route('santri.import.form')
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Throwable $e) {

            return redirect()
                ->route('santri.import.form')
                ->with(
                    'error',
                    'Import gagal. Silakan periksa kembali file Excel Anda.'
                );
        }
    }

    /**
     * Download template Excel.
     */
    public function downloadTemplate()
    {
        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Data Santri');

        $headers = [
            'nomor_induk',
            'nama',
            'tempat_lahir',
            'tanggal_lahir',
            'jenis_kelamin',
            'kamar',
            'sekolah',
            'kelas',
            'alamat',
            'status',
        ];

        $sheet->fromArray($headers, null, 'A1');

        /*
    |--------------------------------------------------------------------------
    | Contoh data
    |--------------------------------------------------------------------------
    */

        $sheet->fromArray([
            [
                '20260001',
                'Ahmad Fulan',
                'Jombang',
                '2012-05-10',
                'L',
                "Maq'adu Shidqin 12",
                'SMP Al Furqan MQ',
                '8',
                'Jombang',
                'aktif',
            ],
            [
                '20260002',
                'Muhammad Fulan',
                'Kediri',
                '2012-08-15',
                'L',
                "Maq'adu Shidqin 12",
                'SMP Al Furqan MQ',
                '8',
                'Kediri',
                'aktif',
            ],
        ], null, 'A2');

        /*
    |--------------------------------------------------------------------------
    | Style header
    |--------------------------------------------------------------------------
    */

        $sheet->getStyle('A1:J1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => [
                    'rgb' => 'FFFFFF',
                ],
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => [
                    'rgb' => '4F46E5',
                ],
            ],
        ]);

        $widths = [
            'A' => 18,
            'B' => 28,
            'C' => 20,
            'D' => 18,
            'E' => 16,
            'F' => 24,
            'G' => 25,
            'H' => 12,
            'I' => 35,
            'J' => 14,
        ];

        foreach ($widths as $column => $width) {
            $sheet->getColumnDimension($column)->setWidth($width);
        }

        /*
    |--------------------------------------------------------------------------
    | Sheet petunjuk
    |--------------------------------------------------------------------------
    */

        $petunjuk = $spreadsheet->createSheet();
        $petunjuk->setTitle('Petunjuk');

        $petunjuk->fromArray([
            ['PETUNJUK IMPORT DATA SANTRI - SIPOLI MQ'],
            [''],
            ['Kolom', 'Wajib', 'Keterangan'],
            ['nomor_induk', 'Ya', 'Nomor induk santri dan harus unik.'],
            ['nama', 'Ya', 'Nama lengkap santri.'],
            ['tempat_lahir', 'Tidak', 'Tempat lahir santri.'],
            ['tanggal_lahir', 'Tidak', 'Format YYYY-MM-DD, contoh 2012-05-10.'],
            ['jenis_kelamin', 'Ya', 'Isi L atau P.'],
            ['kamar', 'Tidak', 'Nama atau nomor kamar.'],
            ['sekolah', 'Tidak', 'Nama sekolah/unit pendidikan.'],
            ['kelas', 'Tidak', 'Kelas santri.'],
            ['alamat', 'Tidak', 'Alamat santri.'],
            ['status', 'Ya', 'Isi aktif atau nonaktif.'],
            [''],
            ['Catatan penting:'],
            ['1.', '', 'Jangan mengubah nama header pada sheet Data Santri.'],
            ['2.', '', 'nomor_induk yang sudah ada akan ditolak.'],
            ['3.', '', 'Hapus contoh data sebelum melakukan import.'],
            ['4.', '', 'Simpan file dalam format .xlsx.'],
        ], null, 'A1');

        $petunjuk->getStyle('A1')->getFont()->setBold(true)->setSize(16);

        $petunjuk->getStyle('A3:C3')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => [
                    'rgb' => 'FFFFFF',
                ],
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => [
                    'rgb' => '4F46E5',
                ],
            ],
        ]);

        $petunjuk->getColumnDimension('A')->setWidth(24);
        $petunjuk->getColumnDimension('B')->setWidth(12);
        $petunjuk->getColumnDimension('C')->setWidth(75);

        /*
    |--------------------------------------------------------------------------
    | Download
    |--------------------------------------------------------------------------
    */

        $writer = new Xlsx($spreadsheet);

        $filename = 'template_import_santri_sipoli_mq.xlsx';

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $filename);
    }

    /**
     * Menyimpan santri baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_induk' => [
                'required',
                'string',
                'max:50',
                'unique:santri,nomor_induk',
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
        ]);

        Santri::create($validated);

        return redirect()
            ->route('santri.index')
            ->with('success', 'Data santri berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail santri.
     */
    public function show(Santri $santri): View
    {
        $santri->load([
            'alergis',
        ]);

        return view('santri.show', compact('santri'));
    }

    /**
     * Menampilkan form edit santri.
     */
    public function edit(Santri $santri): View
    {
        return view('santri.edit', compact('santri'));
    }

    /**
     * Memperbarui data santri.
     */
    public function update(Request $request, Santri $santri)
    {
        $validated = $request->validate([
            'nomor_induk' => [
                'required',
                'string',
                'max:50',
                'unique:santri,nomor_induk,' . $santri->id,
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
        ]);

        $santri->update($validated);

        return redirect()
            ->route('santri.show', $santri)
            ->with('success', 'Data santri berhasil diperbarui.');
    }

    /**
     * Menonaktifkan santri.
     */
    public function destroy(Santri $santri)
    {
        $santri->update([
            'status' => 'nonaktif',
        ]);

        return redirect()
            ->route('santri.index')
            ->with('success', 'Santri berhasil dinonaktifkan.');
    }
}
