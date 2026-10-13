<?php

namespace App\Http\Controllers;

use App\Models\Diagnosa;
use App\Models\Kunjungan;
use App\Models\Obat;
use App\Models\Rujukan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard SIPOLI-MQ.
     */
    public function index(Request $request): View
    {
        $periodeKunjungan = $request->input('periode_kunjungan', 'hari');
        $periodeDiagnosa = $request->input('periode_diagnosa', 'hari');

        $grafikKunjungan = match ($periodeKunjungan) {

            'minggu' => collect(range(0, 6))->map(function ($i) {
                $tanggal = now()->startOfWeek()->addDays($i);

                $total = Kunjungan::query()
                    ->whereDate('tanggal', $tanggal->toDateString())
                    ->count();

                return [
                    'label' => $tanggal
                        ->locale('id')
                        ->translatedFormat('D'),
                    'total' => $total,
                ];
            }),

            'bulan' => collect(range(0, now()->daysInMonth - 1))->map(function ($i) {
                $tanggal = now()->startOfMonth()->addDays($i);

                $total = Kunjungan::query()
                    ->whereDate('tanggal', $tanggal->toDateString())
                    ->count();

                return [
                    'label' => $tanggal->format('d'),
                    'total' => $total,
                ];
            }),

            'tahun' => collect(range(1, 12))->map(function ($bulan) {
                $total = Kunjungan::query()
                    ->whereYear('tanggal', now()->year)
                    ->whereMonth('tanggal', $bulan)
                    ->count();

                return [
                    'label' => Carbon::create()
                        ->month($bulan)
                        ->locale('id')
                        ->translatedFormat('M'),
                    'total' => $total,
                ];
            }),

            default => collect(range(0, 23))->map(function ($jam) {
                $total = Kunjungan::query()
                    ->whereDate('tanggal', today())
                    ->whereRaw('HOUR(waktu) = ?', [$jam])
                    ->count();

                return [
                    'label' => str_pad($jam, 2, '0', STR_PAD_LEFT) . ':00',
                    'total' => $total,
                ];
            }),
        };

        $grafikDiagnosa = match ($periodeDiagnosa) {

            'minggu' => Kunjungan::query()
                ->whereBetween('tanggal', [
                    now()->startOfWeek()->toDateString(),
                    now()->endOfWeek()->toDateString(),
                ])
                ->with('diagnosas')
                ->get()
                ->flatMap(fn($kunjungan) => $kunjungan->diagnosas)
                ->groupBy('id')
                ->map(fn($diagnosas) => [
                    'label' => $diagnosas->first()->nama,
                    'total' => $diagnosas->count(),
                ])
                ->sortByDesc('total')
                ->take(5)
                ->values(),

            'bulan' => Kunjungan::query()
                ->whereBetween('tanggal', [
                    now()->startOfMonth()->toDateString(),
                    now()->endOfMonth()->toDateString(),
                ])
                ->with('diagnosas')
                ->get()
                ->flatMap(fn($kunjungan) => $kunjungan->diagnosas)
                ->groupBy('id')
                ->map(fn($diagnosas) => [
                    'label' => $diagnosas->first()->nama,
                    'total' => $diagnosas->count(),
                ])
                ->sortByDesc('total')
                ->take(5)
                ->values(),

            default => Kunjungan::query()
                ->whereDate('tanggal', today())
                ->with('diagnosas')
                ->get()
                ->flatMap(fn($kunjungan) => $kunjungan->diagnosas)
                ->groupBy('id')
                ->map(fn($diagnosas) => [
                    'label' => $diagnosas->first()->nama,
                    'total' => $diagnosas->count(),
                ])
                ->sortByDesc('total')
                ->take(5)
                ->values(),
        };

        $data = [
            // Statistik utama
            'totalKunjungan' => Kunjungan::count(),
            'totalDiagnosa' => Diagnosa::where('is_active', true)->count(),
            'totalRujukan' => Rujukan::count(),

            // Statistik pelayanan hari ini
            'kunjunganHariIni' => Kunjungan::whereDate('tanggal', today())->count(),

            'selesaiHariIni' => Kunjungan::whereDate('tanggal', today())
                ->where('status', 'selesai')
                ->count(),

            'diperiksaHariIni' => Kunjungan::whereDate('tanggal', today())
                ->where('status', 'diperiksa')
                ->count(),

            'menungguHariIni' => Kunjungan::whereDate('tanggal', today())
                ->where('status', 'menunggu')
                ->count(),

            // Obat stok menipis
            'obatStokMenipis' => Obat::where('is_active', true)
                ->whereColumn('stok', '<=', 'stok_minimum')
                ->where('stok', '>', 0)
                ->orderBy('stok')
                ->orderBy('nama')
                ->limit(5)
                ->get(),

            // Obat habis
            'obatHabis' => Obat::where('is_active', true)
                ->where('stok', 0)
                ->orderBy('nama')
                ->limit(5)
                ->get(),

            // Kunjungan terbaru
            'kunjunganTerbaru' => Kunjungan::with('santri')
                ->orderByDesc('tanggal')
                ->orderByDesc('waktu')
                ->limit(5)
                ->get(),

            // Rujukan terbaru
            'rujukanTerbaru' => Rujukan::with([
                'kunjungan.santri',
                'masterRujukan',
            ])
                ->orderByDesc('tanggal_rujukan')
                ->limit(5)
                ->get(),

            // Periode grafik
            'periodeKunjungan' => $periodeKunjungan,
            'periodeDiagnosa' => $periodeDiagnosa,

            'grafikKunjungan' => $grafikKunjungan,
            'grafikDiagnosa' => $grafikDiagnosa,
        ];

        return view('dashboard', $data);
    }
}
