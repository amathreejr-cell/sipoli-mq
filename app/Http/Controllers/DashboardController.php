<?php

namespace App\Http\Controllers;

use App\Models\Diagnosa;
use App\Models\Kunjungan;
use App\Models\Obat;
use App\Models\Rujukan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard SIPOLI-MQ.
     */
    public function index(Request $request): View
    {
        $periodeKunjungan = $request->input('periode_kunjungan', 'hari');
        $periodeDiagnosa = $request->input('periode_diagnosa', 'hari');

        $periodeGender = $request->input('periode_gender', 'hari');

        [$awalGender, $akhirGender] = match ($periodeGender) {
            'minggu' => [
                now()->startOfWeek()->toDateString(),
                now()->endOfWeek()->toDateString(),
            ],
            'bulan' => [
                now()->startOfMonth()->toDateString(),
                now()->endOfMonth()->toDateString(),
            ],
            'tahun' => [
                now()->startOfYear()->toDateString(),
                now()->endOfYear()->toDateString(),
            ],
            default => [
                today()->toDateString(),
                today()->toDateString(),
            ],
        };

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

        // Statistik pelayanan berdasarkan gender dan periode

        $hitungKunjunganGender = function (?string $gender = null) use ($awalGender, $akhirGender) {
            $query = Kunjungan::query()
                ->whereBetween('tanggal', [$awalGender, $akhirGender]);

            if ($gender !== null) {
                $query->whereHas('santri', function ($q) use ($gender) {
                    $q->where('jenis_kelamin', $gender);
                });
            }

            return $query->count();
        };

        $hitungDiagnosaGender = function (?string $gender = null) use ($awalGender, $akhirGender) {
            $query = DB::table('kunjungan_diagnosa')
                ->join('kunjungans', 'kunjungan_diagnosa.kunjungan_id', '=', 'kunjungans.id')
                ->join('santri', 'kunjungans.santri_id', '=', 'santri.id')
                ->whereBetween('kunjungans.tanggal', [$awalGender, $akhirGender]);

            if ($gender !== null) {
                $query->where('santri.jenis_kelamin', $gender);
            }

            return $query->count();
        };

        $hitungObatGender = function (?string $gender = null) use ($awalGender, $akhirGender) {
            $query = DB::table('reseps')
                ->join('kunjungans', 'reseps.kunjungan_id', '=', 'kunjungans.id')
                ->join('santri', 'kunjungans.santri_id', '=', 'santri.id')
                ->whereBetween('kunjungans.tanggal', [$awalGender, $akhirGender])
                ->whereExists(function ($subquery) {
                    $subquery->select(DB::raw(1))
                        ->from('resep_details')
                        ->whereColumn('resep_details.resep_id', 'reseps.id');
                });

            if ($gender !== null) {
                $query->where('santri.jenis_kelamin', $gender);
            }

            return $query->distinct()->count('reseps.kunjungan_id');
        };

        $hitungRujukanGender = function (?string $gender = null) use ($awalGender, $akhirGender) {
            $query = Rujukan::query()
                ->whereHas('kunjungan', function ($q) use ($awalGender, $akhirGender) {
                    $q->whereBetween('tanggal', [$awalGender, $akhirGender]);
                });

            if ($gender !== null) {
                $query->whereHas('kunjungan.santri', function ($q) use ($gender) {
                    $q->where('jenis_kelamin', $gender);
                });
            }

            return $query->count();
        };

        $statistikGender = [
            'kunjungan' => [
                'global' => $hitungKunjunganGender(),
                'laki' => $hitungKunjunganGender('L'),
                'perempuan' => $hitungKunjunganGender('P'),
            ],
            'diagnosa' => [
                'global' => $hitungDiagnosaGender(),
                'laki' => $hitungDiagnosaGender('L'),
                'perempuan' => $hitungDiagnosaGender('P'),
            ],
            'obat' => [
                'global' => $hitungObatGender(),
                'laki' => $hitungObatGender('L'),
                'perempuan' => $hitungObatGender('P'),
            ],
            'rujukan' => [
                'global' => $hitungRujukanGender(),
                'laki' => $hitungRujukanGender('L'),
                'perempuan' => $hitungRujukanGender('P'),
            ],
        ];

        $data = [
            // Statistik utama
            'totalKunjungan' => Kunjungan::count(),
            'totalDiagnosa' => Diagnosa::where('is_active', true)->count(),
            'totalRujukan' => Rujukan::count(),
            'periodeGender' => $periodeGender,
            'statistikGender' => $statistikGender,

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
