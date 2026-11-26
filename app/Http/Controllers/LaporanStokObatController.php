<?php

namespace App\Http\Controllers;

use App\Exports\StokObatExport;
use App\Models\Obat;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\View\View;

class LaporanStokObatController extends Controller
{
    private function dataLaporan(Request $request): array
    {
        $tanggalMulai = $request->input(
            'tanggal_mulai',
            now()->startOfMonth()->toDateString()
        );

        $tanggalSelesai = $request->input(
            'tanggal_selesai',
            today()->toDateString()
        );

        // Validasi periode laporan.
        validator([
            'tanggal_mulai' => $tanggalMulai,
            'tanggal_selesai' => $tanggalSelesai,
        ], [
            'tanggal_mulai' => ['required', 'date'],
            'tanggal_selesai' => [
                'required',
                'date',
                'after_or_equal:tanggal_mulai',
            ],
        ])->validate();

        $queryObat = Obat::query();

        if ($request->filled('cari')) {
            $cari = $request->input('cari');

            $queryObat->where(function ($query) use ($cari) {
                $query->where('nama', 'like', "%{$cari}%")
                    ->orWhere('kode', 'like', "%{$cari}%");
            });
        }

        if ($request->filled('obat_id')) {
            $queryObat->where('id', $request->input('obat_id'));
        }

        $obats = $queryObat->orderBy('nama')->get();

        $laporan = $obats->map(function ($obat) use (
            $tanggalMulai,
            $tanggalSelesai
        ) {
            /*
             * Menghitung stok awal dari stok sekarang dan seluruh
             * mutasi sejak awal periode hingga saat ini.
             * Mengasumsikan seluruh perubahan stok tercatat di mutasi_stoks.
             */
            $mutasiSetelahAwal = DB::table('mutasi_stoks')
                ->where('obat_id', $obat->id)
                ->where('created_at', '>=', $tanggalMulai . ' 00:00:00')
                ->selectRaw("
                    COALESCE(SUM(
                        CASE WHEN jenis = 'masuk' THEN jumlah ELSE 0 END
                    ), 0) as total_masuk,
                    COALESCE(SUM(
                        CASE WHEN jenis = 'keluar' THEN jumlah ELSE 0 END
                    ), 0) as total_keluar
                ")
                ->first();

            $stokAwal = (int) $obat->stok
                - (int) $mutasiSetelahAwal->total_masuk
                + (int) $mutasiSetelahAwal->total_keluar;

            $mutasiPeriode = DB::table('mutasi_stoks')
                ->where('mutasi_stoks.obat_id', $obat->id)
                ->whereBetween('mutasi_stoks.created_at', [
                    $tanggalMulai . ' 00:00:00',
                    $tanggalSelesai . ' 23:59:59',
                ])
                ->selectRaw("
                    COALESCE(SUM(
                        CASE WHEN jenis = 'masuk' THEN jumlah ELSE 0 END
                    ), 0) as total_masuk,
                    COALESCE(SUM(
                        CASE WHEN jenis = 'keluar' THEN jumlah ELSE 0 END
                    ), 0) as total_keluar
                ")
                ->first();

            // Pemakaian obat berdasarkan jenis kelamin santri.
            $pemakaian = DB::table('mutasi_stoks')
                ->leftJoin(
                    'resep_details',
                    'mutasi_stoks.resep_detail_id',
                    '=',
                    'resep_details.id'
                )
                ->leftJoin(
                    'reseps',
                    'resep_details.resep_id',
                    '=',
                    'reseps.id'
                )
                ->leftJoin(
                    'kunjungans',
                    'reseps.kunjungan_id',
                    '=',
                    'kunjungans.id'
                )
                ->leftJoin('santri', 'kunjungans.santri_id', '=', 'santri.id')
                ->where('mutasi_stoks.obat_id', $obat->id)
                ->where('mutasi_stoks.jenis', 'keluar')
                ->whereBetween('mutasi_stoks.created_at', [
                    $tanggalMulai . ' 00:00:00',
                    $tanggalSelesai . ' 23:59:59',
                ])
                ->selectRaw("
                    COALESCE(SUM(
                        CASE WHEN santri.jenis_kelamin = 'L'
                        THEN mutasi_stoks.jumlah ELSE 0 END
                    ), 0) as putra,
                    COALESCE(SUM(
                        CASE WHEN santri.jenis_kelamin = 'P'
                        THEN mutasi_stoks.jumlah ELSE 0 END
                    ), 0) as putri
                ")
                ->first();

            $stokMasuk = (int) $mutasiPeriode->total_masuk;
            $totalKeluar = (int) $mutasiPeriode->total_keluar;
            $putra = (int) $pemakaian->putra;
            $putri = (int) $pemakaian->putri;

            return [
                'id' => $obat->id,
                'kode' => $obat->kode,
                'nama' => $obat->nama,
                'bentuk' => $obat->bentuk,
                'satuan' => $obat->satuan,
                'stok_awal' => $stokAwal,
                'stok_masuk' => $stokMasuk,
                'jumlah_stok' => $stokAwal + $stokMasuk,
                'terpakai_putra' => $putra,
                'terpakai_putri' => $putri,
                'total_keluar' => $totalKeluar,
                'keluar_lainnya' => max(0, $totalKeluar - $putra - $putri),
                'sisa_stok' => $stokAwal + $stokMasuk - $totalKeluar,
                'stok_saat_ini' => (int) $obat->stok,
            ];
        });

        // Rincian transaksi keluar per obat dan tanggal.
        $rincianQuery = DB::table('mutasi_stoks')
            ->join('obats', 'mutasi_stoks.obat_id', '=', 'obats.id')
            ->leftJoin(
                'resep_details',
                'mutasi_stoks.resep_detail_id',
                '=',
                'resep_details.id'
            )
            ->leftJoin(
                'reseps',
                'resep_details.resep_id',
                '=',
                'reseps.id'
            )
            ->leftJoin(
                'kunjungans',
                'reseps.kunjungan_id',
                '=',
                'kunjungans.id'
            )
            ->leftJoin('santri', 'kunjungans.santri_id', '=', 'santri.id')
            ->where('mutasi_stoks.jenis', 'keluar')
            ->whereBetween('mutasi_stoks.created_at', [
                $tanggalMulai . ' 00:00:00',
                $tanggalSelesai . ' 23:59:59',
            ]);

        if ($request->filled('obat_id')) {
            $rincianQuery->where('mutasi_stoks.obat_id', $request->input('obat_id'));
        }

        if ($request->filled('cari')) {
            $cari = $request->input('cari');

            $rincianQuery->where(function ($query) use ($cari) {
                $query->where('obats.nama', 'like', "%{$cari}%")
                    ->orWhere('obats.kode', 'like', "%{$cari}%");
            });
        }

        $rincian = $rincianQuery
            ->select(
                'mutasi_stoks.id',
                'mutasi_stoks.created_at',
                'obats.kode',
                'obats.nama as nama_obat',
                'obats.satuan',
                'mutasi_stoks.jumlah',
                'mutasi_stoks.keterangan',
                'santri.nama as nama_santri',
                'santri.jenis_kelamin'
            )
            ->orderByDesc('mutasi_stoks.created_at')
            ->get();

        return [
            'laporan' => $laporan,
            'rincian' => $rincian,
            'tanggalMulai' => $tanggalMulai,
            'tanggalSelesai' => $tanggalSelesai,
            'daftarObat' => Obat::orderBy('nama')->get(['id', 'kode', 'nama']),
            'totalJenisObat' => $laporan->count(),
            'totalStokAwal' => $laporan->sum('stok_awal'),
            'totalStokMasuk' => $laporan->sum('stok_masuk'),
            'totalPutra' => $laporan->sum('terpakai_putra'),
            'totalPutri' => $laporan->sum('terpakai_putri'),
            'totalKeluar' => $laporan->sum('total_keluar'),
            'totalSisa' => $laporan->sum('sisa_stok'),
        ];
    }

    public function index(Request $request): View
    {
        $data = $this->dataLaporan($request);

        return view('laporan.stok-obat', $data);
    }

    public function pdf(Request $request)
    {
        $data = $this->dataLaporan($request);

        $pdf = Pdf::loadView('laporan.stok-obat-pdf', $data)
            ->setPaper('a4', 'landscape');

        return $pdf->download(
            'laporan-stok-obat-' . now()->format('Ymd-His') . '.pdf'
        );
    }

    public function excel(Request $request)
    {
        $data = $this->dataLaporan($request);

        return Excel::download(
            new StokObatExport($data['laporan']),
            'laporan-stok-obat-' . now()->format('Ymd-His') . '.xlsx'
        );
    }
}
