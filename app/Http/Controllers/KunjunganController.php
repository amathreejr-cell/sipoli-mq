<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\Santri;
use App\Models\User;
use App\Models\IdentitasPoliklinik;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\Collection;

class KunjunganController extends Controller
{
    public function index(Request $request): View
    {
        $kunjungans = Kunjungan::with(['santri', 'petugas'])
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search')->toString();

                $query->where(function ($q) use ($search) {
                    $q->whereHas('santri', function ($santriQuery) use ($search) {
                        $santriQuery
                            ->where('nama', 'like', "%{$search}%")
                            ->orWhere('nomor_induk', 'like', "%{$search}%");
                    })
                        ->orWhere('kode_kunjungan', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->string('status')->toString());
            })
            ->orderByDesc('tanggal')
            ->orderByDesc('waktu')
            ->paginate(10)
            ->withQueryString();

        return view('kunjungan.index', compact('kunjungans'));
    }

    public function rekamMedis(Request $request): View
    {
        $keyword = $request->string('q')->toString();

        $kunjungans = Kunjungan::query()
            ->with([
                'santri',
                'diagnosas',
                'tindakans',
            ])
            ->where('status', 'selesai')
            ->when($keyword !== '', function ($query) use ($keyword) {
                $query->whereHas('santri', function ($santriQuery) use ($keyword) {
                    $santriQuery
                        ->where('nama', 'like', "%{$keyword}%")
                        ->orWhere('nomor_induk', 'like', "%{$keyword}%");
                });
            })
            ->orderByDesc('tanggal')
            ->orderByDesc('waktu')
            ->paginate(10)
            ->withQueryString();

        return view('rekam-medis.index', compact('kunjungans', 'keyword'));
    }

    private function dataLaporan(
        string $tanggalMulai,
        string $tanggalSelesai
    ) {
        return Kunjungan::query()
            ->with([
                'santri',
                'petugas',
                'diagnosas',
                'tindakans',
            ])
            ->whereDate('tanggal', '>=', $tanggalMulai)
            ->whereDate('tanggal', '<=', $tanggalSelesai)
            ->where('status', 'selesai')
            ->orderBy('tanggal')
            ->orderBy('waktu')
            ->get();
    }

    private function susunStatistikLaporan(Collection $kunjungans): array
    {
        /*
    |--------------------------------------------------------------------------
    | A. KUNJUNGAN PER TANGGAL
    |--------------------------------------------------------------------------
    */

        $perTanggal = $kunjungans
            ->groupBy(function ($kunjungan) {
                return $kunjungan->tanggal?->format('Y-m-d');
            })
            ->map(function ($items, $tanggal) {

                $laki = $items->filter(
                    fn($item) => $item->santri?->jenis_kelamin === 'L'
                )->count();

                $perempuan = $items->filter(
                    fn($item) => $item->santri?->jenis_kelamin === 'P'
                )->count();

                return [
                    'tanggal' => $tanggal,
                    'label' => Carbon::parse($tanggal)
                        ->locale('id')
                        ->translatedFormat('d F Y'),
                    'laki_laki' => $laki,
                    'perempuan' => $perempuan,
                    'total' => $items->count(),
                ];
            })
            ->values();


        /*
    |--------------------------------------------------------------------------
    | B. KUNJUNGAN BERDASARKAN TINDAKAN
    |--------------------------------------------------------------------------
    */

        $perTindakan = [];

        foreach ($kunjungans as $kunjungan) {

            foreach ($kunjungan->tindakans as $tindakan) {

                $key = $tindakan->id;

                if (!isset($perTindakan[$key])) {
                    $perTindakan[$key] = [
                        'kode' => $tindakan->kode,
                        'nama' => $tindakan->nama,
                        'laki_laki' => 0,
                        'perempuan' => 0,
                        'total' => 0,
                    ];
                }

                if ($kunjungan->santri?->jenis_kelamin === 'L') {
                    $perTindakan[$key]['laki_laki']++;
                }

                if ($kunjungan->santri?->jenis_kelamin === 'P') {
                    $perTindakan[$key]['perempuan']++;
                }

                $perTindakan[$key]['total']++;
            }
        }

        $perTindakan = collect($perTindakan)
            ->sortByDesc('total')
            ->values();


        /*
    |--------------------------------------------------------------------------
    | C. JENIS KELAMIN
    |--------------------------------------------------------------------------
    */

        $perJenisKelamin = [
            'Laki-laki' => $kunjungans->filter(
                fn($item) => $item->santri?->jenis_kelamin === 'L'
            )->count(),

            'Perempuan' => $kunjungans->filter(
                fn($item) => $item->santri?->jenis_kelamin === 'P'
            )->count(),
        ];


        /*
    |--------------------------------------------------------------------------
    | D. DIAGNOSA
    |--------------------------------------------------------------------------
    */

        $perDiagnosa = [];

        foreach ($kunjungans as $kunjungan) {

            foreach ($kunjungan->diagnosas as $diagnosa) {

                $key = $diagnosa->id;

                if (!isset($perDiagnosa[$key])) {
                    $perDiagnosa[$key] = [
                        'kode' => $diagnosa->kode,
                        'nama' => $diagnosa->nama,
                        'laki_laki' => 0,
                        'perempuan' => 0,
                        'total' => 0,
                    ];
                }

                if ($kunjungan->santri?->jenis_kelamin === 'L') {
                    $perDiagnosa[$key]['laki_laki']++;
                }

                if ($kunjungan->santri?->jenis_kelamin === 'P') {
                    $perDiagnosa[$key]['perempuan']++;
                }

                $perDiagnosa[$key]['total']++;
            }
        }

        $perDiagnosa = collect($perDiagnosa)
            ->sortByDesc('total')
            ->values();


        /*
    |--------------------------------------------------------------------------
    | E. JAM OPERASIONAL
    |--------------------------------------------------------------------------
    */

        $jamOperasional = [
            'Pagi' => [
                'laki_laki' => 0,
                'perempuan' => 0,
                'total' => 0,
            ],

            'Sore' => [
                'laki_laki' => 0,
                'perempuan' => 0,
                'total' => 0,
            ],

            'Luar Jam Operasional' => [
                'laki_laki' => 0,
                'perempuan' => 0,
                'total' => 0,
            ],
        ];

        foreach ($kunjungans as $kunjungan) {

            if (!$kunjungan->waktu) {
                $kategori = 'Luar Jam Operasional';
            } else {

                $waktu = Carbon::parse($kunjungan->waktu)
                    ->format('H:i');

                if ($waktu >= '07:00' && $waktu <= '14:00') {

                    $kategori = 'Pagi';
                } elseif ($waktu >= '14:30' && $waktu <= '19:30') {

                    $kategori = 'Sore';
                } else {

                    $kategori = 'Luar Jam Operasional';
                }
            }

            $jamOperasional[$kategori]['total']++;

            if ($kunjungan->santri?->jenis_kelamin === 'L') {
                $jamOperasional[$kategori]['laki_laki']++;
            }

            if ($kunjungan->santri?->jenis_kelamin === 'P') {
                $jamOperasional[$kategori]['perempuan']++;
            }
        }


        /*
    |--------------------------------------------------------------------------
    | TOTAL
    |--------------------------------------------------------------------------
    */

        $totalKunjungan = $kunjungans->count();

        return [
            'perTanggal' => $perTanggal,
            'perTindakan' => $perTindakan,
            'perJenisKelamin' => $perJenisKelamin,
            'perDiagnosa' => $perDiagnosa,
            'jamOperasional' => $jamOperasional,
            'totalKunjungan' => $totalKunjungan,
        ];
    }

    public function laporan(Request $request): View
    {
        $tanggalMulai = $request->input(
            'tanggal_mulai',
            now()->startOfMonth()->format('Y-m-d')
        );

        $tanggalSelesai = $request->input(
            'tanggal_selesai',
            now()->format('Y-m-d')
        );

        $kunjungans = $this->dataLaporan(
            $tanggalMulai,
            $tanggalSelesai
        );

        $statistik = $this->susunStatistikLaporan($kunjungans);

        return view('laporan.index', compact(
            'tanggalMulai',
            'tanggalSelesai',
            'kunjungans',
            'statistik'
        ));
    }

    public function laporanPdf(Request $request): Response
    {
        $tanggalMulai = $request->input(
            'tanggal_mulai',
            now()->startOfMonth()->format('Y-m-d')
        );

        $tanggalSelesai = $request->input(
            'tanggal_selesai',
            now()->format('Y-m-d')
        );

        $kunjungans = $this->dataLaporan(
            $tanggalMulai,
            $tanggalSelesai
        );

        $statistik = $this->susunStatistikLaporan($kunjungans);

        $identitas = IdentitasPoliklinik::first();

        if (!$identitas) {
            abort(404, 'Identitas poliklinik belum dikonfigurasi.');
        }

        $pdf = Pdf::loadView(
            'laporan.pdf',
            compact(
                'identitas',
                'tanggalMulai',
                'tanggalSelesai',
                'statistik'
            )
        );

        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream(
            'laporan-pelayanan-' .
                $tanggalMulai .
                '-' .
                $tanggalSelesai .
                '.pdf'
        );
    }

    public function laporanExcel(Request $request): Response
    {
        $tanggalMulai = $request->input(
            'tanggal_mulai',
            now()->startOfMonth()->format('Y-m-d')
        );

        $tanggalSelesai = $request->input(
            'tanggal_selesai',
            now()->format('Y-m-d')
        );

        $kunjungans = $this->dataLaporan(
            $tanggalMulai,
            $tanggalSelesai
        );

        $statistik = $this->susunStatistikLaporan($kunjungans);

        $spreadsheet = new Spreadsheet();

        /*
    |--------------------------------------------------------------------------
    | A. REKAP KUNJUNGAN PER TANGGAL
    |--------------------------------------------------------------------------
    */

        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('A. Per Tanggal');

        $sheet->fromArray([
            ['LAPORAN PELAYANAN POLIKLINIK'],
            [
                'Periode',
                $tanggalMulai,
                's/d',
                $tanggalSelesai
            ],
            [],
            [
                'A. REKAP KUNJUNGAN PER TANGGAL'
            ],
            [
                'Tanggal',
                'Laki-laki',
                'Perempuan',
                'Total'
            ],
        ]);

        $row = 6;

        foreach ($statistik['perTanggal'] as $item) {

            $sheet->fromArray([
                [
                    $item['label'],
                    $item['laki_laki'],
                    $item['perempuan'],
                    $item['total'],
                ]
            ], null, 'A' . $row);

            $row++;
        }

        /*
    |--------------------------------------------------------------------------
    | B. JAM OPERASIONAL
    |--------------------------------------------------------------------------
    */

        $sheet = $spreadsheet->createSheet();
        $sheet->setTitle('B. Jam Operasional');

        $sheet->fromArray([
            ['LAPORAN PELAYANAN POLIKLINIK'],
            [
                'Periode',
                $tanggalMulai,
                's/d',
                $tanggalSelesai
            ],
            [],
            [
                'B. KUNJUNGAN BERDASARKAN JAM OPERASIONAL'
            ],
            [
                'Jam Pelayanan',
                'Keterangan',
                'Laki-laki',
                'Perempuan',
                'Total',
                'Persentase'
            ],
        ]);

        $row = 6;

        foreach ($statistik['jamOperasional'] as $nama => $item) {

            if ($nama === 'Pagi') {
                $keterangan = '07.00 - 14.00';
            } elseif ($nama === 'Sore') {
                $keterangan = '14.30 - 19.30';
            } else {
                $keterangan = 'Di luar jam operasional';
            }

            $persentase = $statistik['totalKunjungan'] > 0
                ? round(
                    ($item['total'] / $statistik['totalKunjungan']) * 100,
                    2
                )
                : 0;

            $sheet->fromArray([
                [
                    $nama,
                    $keterangan,
                    $item['laki_laki'],
                    $item['perempuan'],
                    $item['total'],
                    $persentase . '%',
                ]
            ], null, 'A' . $row);

            $row++;
        }

        /*
    |--------------------------------------------------------------------------
    | C. TINDAKAN
    |--------------------------------------------------------------------------
    */

        $sheet = $spreadsheet->createSheet();
        $sheet->setTitle('C. Tindakan');

        $sheet->fromArray([
            ['LAPORAN PELAYANAN POLIKLINIK'],
            [
                'Periode',
                $tanggalMulai,
                's/d',
                $tanggalSelesai
            ],
            [],
            [
                'C. KUNJUNGAN BERDASARKAN TINDAKAN'
            ],
            [
                'Kode',
                'Tindakan',
                'Laki-laki',
                'Perempuan',
                'Total'
            ],
        ]);

        $row = 6;

        foreach ($statistik['perTindakan'] as $item) {

            $sheet->fromArray([
                [
                    $item['kode'] ?: '-',
                    $item['nama'],
                    $item['laki_laki'],
                    $item['perempuan'],
                    $item['total'],
                ]
            ], null, 'A' . $row);

            $row++;
        }

        /*
    |--------------------------------------------------------------------------
    | D. JENIS KELAMIN
    |--------------------------------------------------------------------------
    */

        $sheet = $spreadsheet->createSheet();
        $sheet->setTitle('D. Jenis Kelamin');

        $sheet->fromArray([
            ['LAPORAN PELAYANAN POLIKLINIK'],
            [
                'Periode',
                $tanggalMulai,
                's/d',
                $tanggalSelesai
            ],
            [],
            [
                'D. KUNJUNGAN BERDASARKAN JENIS KELAMIN'
            ],
            [
                'Jenis Kelamin',
                'Jumlah'
            ],
            [
                'Laki-laki',
                $statistik['perJenisKelamin']['Laki-laki']
            ],
            [
                'Perempuan',
                $statistik['perJenisKelamin']['Perempuan']
            ],
            [
                'Total',
                $statistik['totalKunjungan']
            ],
        ]);

        /*
    |--------------------------------------------------------------------------
    | E. DIAGNOSA
    |--------------------------------------------------------------------------
    */

        $sheet = $spreadsheet->createSheet();
        $sheet->setTitle('E. Diagnosa');

        $sheet->fromArray([
            ['LAPORAN PELAYANAN POLIKLINIK'],
            [
                'Periode',
                $tanggalMulai,
                's/d',
                $tanggalSelesai
            ],
            [],
            [
                'E. KUNJUNGAN BERDASARKAN DIAGNOSA'
            ],
            [
                'Kode',
                'Diagnosa',
                'Laki-laki',
                'Perempuan',
                'Total'
            ],
        ]);

        $row = 6;

        foreach ($statistik['perDiagnosa'] as $item) {

            $sheet->fromArray([
                [
                    $item['kode'] ?: '-',
                    $item['nama'],
                    $item['laki_laki'],
                    $item['perempuan'],
                    $item['total'],
                ]
            ], null, 'A' . $row);

            $row++;
        }

        /*
    |--------------------------------------------------------------------------
    | FORMAT SEMUA SHEET
    |--------------------------------------------------------------------------
    */

        foreach ($spreadsheet->getAllSheets() as $sheet) {

            $highestColumn = $sheet->getHighestColumn();
            $highestRow = $sheet->getHighestRow();

            // Judul
            $sheet->getStyle('A1:' . $highestColumn . '1')
                ->getFont()
                ->setBold(true)
                ->setSize(14);

            // Header periode
            $sheet->getStyle('A2:' . $highestColumn . '2')
                ->getFont()
                ->setBold(true);

            // Judul section
            $sheet->getStyle('A4:' . $highestColumn . '4')
                ->getFont()
                ->setBold(true);

            // Header tabel
            $sheet->getStyle('A5:' . $highestColumn . '5')
                ->getFont()
                ->setBold(true);

            $sheet->getStyle('A5:' . $highestColumn . '5')
                ->getFill()
                ->setFillType(
                    \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID
                )
                ->getStartColor()
                ->setARGB('E2E8F0');

            // Border tabel
            if ($highestRow >= 5) {

                $sheet->getStyle(
                    'A5:' . $highestColumn . $highestRow
                )
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                    );
            }

            // Lebar kolom otomatis
            foreach (range('A', $highestColumn) as $column) {

                $sheet
                    ->getColumnDimension($column)
                    ->setAutoSize(true);
            }

            // Freeze header
            $sheet->freezePane('A6');
        }

        /*
    |--------------------------------------------------------------------------
    | DOWNLOAD
    |--------------------------------------------------------------------------
    */

        $writer = new Xlsx($spreadsheet);

        $filename =
            'laporan-pelayanan-' .
            $tanggalMulai .
            '-' .
            $tanggalSelesai .
            '.xlsx';

        ob_start();

        $writer->save('php://output');

        $content = ob_get_clean();

        return response($content, 200, [
            'Content-Type' =>
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',

            'Content-Disposition' =>
            'attachment; filename="' . $filename . '"',

            'Cache-Control' =>
            'max-age=0',
        ]);
    }

    public function create(Request $request): View
    {
        $santriTerpilih = null;

        if ($request->filled('santri_id')) {
            $santriTerpilih = Santri::query()
                ->where('id', $request->santri_id)
                ->where('status', 'aktif')
                ->first();
        }

        return view('kunjungan.create', [
            'tanggalSekarang' => now()->format('Y-m-d'),
            'waktuSekarang' => now()->format('H:i'),
            'santriTerpilih' => $santriTerpilih,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'santri_id' => [
                'required',
                'exists:santri,id',
            ],

            'tanggal' => [
                'required',
                'date',
            ],

            'waktu' => [
                'required',
                'date_format:H:i',
            ],

            'keluhan' => [
                'required',
                'string',
            ],

            'catatan' => [
                'nullable',
                'string',
            ],
        ]);

        $validated['petugas_id'] = Auth::id();

        $validated['status'] = 'menunggu';

        $validated['kode_kunjungan'] =
            'KJ-' . now()->format('YmdHis') . '-' . random_int(100, 999);

        $kunjungan = Kunjungan::create($validated);

        return redirect()
            ->route('kunjungan.show', $kunjungan)
            ->with('success', 'Kunjungan berhasil dibuat.');
    }

    public function show(Kunjungan $kunjungan): View|RedirectResponse
    {
        if (
            $kunjungan->status === 'diperiksa'
            && in_array(Auth::user()->role, ['admin', 'petugas'])
        ) {
            return redirect()
                ->route('pemeriksaan.create', $kunjungan)
                ->with('error', 'Pemeriksaan sedang berlangsung. Silakan lanjutkan proses pemeriksaan.');
        }

        $kunjungan->load([
            'santri.alergis',
            'petugas',
            'pemeriksaan',
            'diagnosas',
            'tindakans',
            'resep.details.obat',
            'rujukan',
        ]);

        return view('kunjungan.show', compact('kunjungan'));
    }

    public function riwayatSantri(Santri $santri)
    {
        $kunjungans = Kunjungan::query()
            ->with([
                'diagnosas',
                'tindakans',
                'resep.details.obat',
                'rujukan.masterRujukan',
            ])
            ->where('santri_id', $santri->id)
            ->whereIn('status', ['diperiksa', 'selesai'])
            ->orderByDesc('tanggal')
            ->orderByDesc('waktu')
            ->limit(5)
            ->get();

        return response()->json([
            'santri' => [
                'id' => $santri->id,
                'nomor_induk' => $santri->nomor_induk,
                'nama' => $santri->nama,
            ],

            'kunjungans' => $kunjungans->map(function ($kunjungan) {

                return [
                    'id' => $kunjungan->id,

                    'tanggal' => $kunjungan->tanggal?->format('d-m-Y'),

                    'waktu' => $kunjungan->waktu,

                    'keluhan' => $kunjungan->keluhan,

                    'diagnosa' => $kunjungan->diagnosas
                        ->pluck('nama')
                        ->values(),

                    'tindakan' => $kunjungan->tindakans
                        ->pluck('nama')
                        ->values(),

                    /*
                |--------------------------------------------------------------------------
                | OBAT / RESEP
                |--------------------------------------------------------------------------
                */

                    'resep' => $kunjungan->resep
                        ? [
                            'catatan' => $kunjungan->resep->catatan,

                            'details' => $kunjungan->resep->details
                                ->map(function ($detail) {

                                    return [
                                        'obat' => $detail->obat?->nama ?? '-',

                                        'jumlah' => $detail->jumlah,

                                        'satuan' => $detail->obat?->satuan ?? '',

                                        'dosis' => $detail->dosis,

                                        'frekuensi' => $detail->frekuensi,

                                        'aturan_pakai' => $detail->aturan_pakai,

                                        'keterangan' => $detail->keterangan,
                                    ];
                                })
                                ->values(),
                        ]
                        : null,

                    /*
                |--------------------------------------------------------------------------
                | RUJUKAN
                |--------------------------------------------------------------------------
                */

                    'rujukan' => $kunjungan->rujukan
                        ? [
                            'tanggal' => $kunjungan->rujukan->tanggal_rujukan?->format('d-m-Y'),

                            'fasilitas' => $kunjungan->rujukan
                                ->masterRujukan?->nama_fasilitas,

                            'status' => $kunjungan->rujukan->status,

                            'alasan' => $kunjungan->rujukan->alasan,

                            'keterangan' => $kunjungan->rujukan->keterangan,
                        ]
                        : null,

                    'status' => $kunjungan->status,
                ];
            }),
        ]);
    }

    public function edit(Kunjungan $kunjungan): View|RedirectResponse
    {
        if (
            $kunjungan->status === 'selesai'
            && Auth::user()->role !== 'admin'
        ) {
            return redirect()
                ->route('kunjungan.show', $kunjungan)
                ->with('error', 'Kunjungan yang sudah selesai tidak dapat diedit.');
        }

        $santris = Santri::query()
            ->where('status', 'aktif')
            ->orderBy('nama')
            ->get();

        $petugas = User::query()
            ->whereIn('role', ['admin', 'petugas'])
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('kunjungan.edit', compact(
            'kunjungan',
            'santris',
            'petugas'
        ));
    }

    public function update(Request $request, Kunjungan $kunjungan): RedirectResponse
    {
        if (
            $kunjungan->status === 'selesai'
            && Auth::user()->role !== 'admin'
        ) {
            return redirect()
                ->route('kunjungan.show', $kunjungan)
                ->with('error', 'Kunjungan yang sudah selesai tidak dapat diedit.');
        }

        $validated = $request->validate([
            'tanggal' => [
                'required',
                'date',
            ],

            'waktu' => [
                'required',
                'date_format:H:i',
            ],

            'keluhan' => [
                'required',
                'string',
            ],

            'catatan' => [
                'nullable',
                'string',
            ],
        ]);

        $kunjungan->update($validated);

        return redirect()
            ->route('kunjungan.show', $kunjungan)
            ->with('success', 'Data kunjungan berhasil diperbarui.');
    }

    public function destroy(Kunjungan $kunjungan)
    {
        $kunjungan->update([
            'status' => 'dibatalkan',
        ]);

        return redirect()
            ->route('kunjungan.index')
            ->with('success', 'Kunjungan berhasil dibatalkan.');
    }
}
