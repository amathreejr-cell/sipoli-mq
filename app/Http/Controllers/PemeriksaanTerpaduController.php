<?php

namespace App\Http\Controllers;

use App\Models\Diagnosa;
use App\Models\Kunjungan;
use App\Models\MasterRujukan;
use App\Models\MutasiStok;
use App\Models\Obat;
use App\Models\Pemeriksaan;
use App\Models\Resep;
use App\Models\Tindakan;
use App\Models\Rujukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PemeriksaanTerpaduController extends Controller
{
    public function create(Kunjungan $kunjungan)
    {
        if (in_array($kunjungan->status, ['selesai', 'dibatalkan'], true)) {
            return redirect()
                ->route('kunjungan.show', $kunjungan)
                ->with('error', 'Kunjungan ini sudah ditutup.');
        }

        $kunjungan->load([
            'santri',
            'pemeriksaan',
            'diagnosas',
            'tindakans',
            'resep.details.obat',
            'rujukan',
        ]);

        $diagnosas = Diagnosa::where('is_active', true)->orderBy('nama')->get();
        $tindakans = Tindakan::where('is_active', true)->orderBy('nama')->get();
        $obats = Obat::where('is_active', true)->orderBy('nama')->get();
        $masterRujukans = MasterRujukan::where('is_active', true)
            ->orderBy('nama_fasilitas')
            ->get();

        return view('pemeriksaan-terpadu.create', compact(
            'kunjungan',
            'diagnosas',
            'tindakans',
            'obats',
            'masterRujukans'
        ));
    }

    public function store(Request $request, Kunjungan $kunjungan)
    {
        // 1. Pastikan kunjungan masih dapat diubah.
        if (in_array($kunjungan->status, ['selesai', 'dibatalkan'], true)) {
            return redirect()
                ->route('kunjungan.show', $kunjungan)
                ->with(
                    'error',
                    'Kunjungan ini sudah ditutup dan tidak dapat diubah melalui formulir terpadu.'
                );
        }

        // 2. Validasi seluruh input formulir.
        $data = $request->validate([
            // Pemeriksaan fisik
            'tekanan_darah' => ['required', 'string', 'max:20'],
            'suhu' => ['required', 'numeric', 'between:30,45'],
            'nadi' => ['nullable', 'integer', 'min:0', 'max:250'],
            'pernapasan' => ['nullable', 'integer', 'min:0', 'max:100'],
            'berat_badan' => ['nullable', 'numeric', 'min:0', 'max:300'],
            'tinggi_badan' => ['nullable', 'numeric', 'min:0', 'max:250'],
            'pemeriksaan_fisik' => ['nullable', 'string'],
            'catatan_pemeriksaan' => ['nullable', 'string'],

            // Diagnosa
            'diagnosa_ids' => ['required', 'array', 'min:1'],
            'diagnosa_ids.*' => [
                'required',
                'integer',
                'distinct',
                'exists:diagnosas,id',
            ],
            'catatan_diagnosa' => ['nullable', 'string'],

            // Tindakan
            'tindakan_ids' => ['required', 'array', 'min:1'],
            'tindakan_ids.*' => [
                'required',
                'integer',
                'distinct',
                'exists:tindakans,id',
            ],
            'catatan_tindakan' => ['nullable', 'string'],

            // Resep dan obat
            'obat_ids' => ['nullable', 'array'],
            'obat_ids.*' => [
                'required',
                'integer',
                'distinct',
                'exists:obats,id',
            ],

            'jumlah' => ['nullable', 'array'],
            'jumlah.*' => ['required', 'integer', 'min:1'],

            'dosis' => ['nullable', 'array'],
            'dosis.*' => ['required', 'string', 'max:100'],

            'frekuensi' => ['nullable', 'array'],
            'frekuensi.*' => ['required', 'string', 'max:100'],

            'aturan_pakai' => ['nullable', 'array'],
            'aturan_pakai.*' => ['required', 'string', 'max:150'],

            'keterangan' => ['nullable', 'array'],
            'keterangan.*' => ['nullable', 'string', 'max:255'],

            'catatan_resep' => ['nullable', 'string'],

            // Rujukan
            'rujukan_id' => [
                'nullable',
                'integer',
                'exists:master_rujukan,id',
            ],
            'tanggal_rujukan' => ['nullable', 'date'],
            'status_rujukan' => [
                'nullable',
                'in:direncanakan,dirujuk,selesai,dibatalkan',
            ],
            'alasan_rujukan' => ['nullable', 'string'],
            'keterangan_rujukan' => ['nullable', 'string'],
        ]);

        // 3. Tentukan kebutuhan pelayanan secara independen.
        // Tidak lagi bergantung pada field perlu_rujukan atau perlu_obat.
        $obatIds = $data['obat_ids'] ?? [];

        $perluObat = count($obatIds) > 0;
        $perluRujukan = !empty($data['rujukan_id']);

        // 4. Validasi detail rujukan hanya jika fasilitas rujukan dipilih.
        if ($perluRujukan) {
            $request->validate([
                'rujukan_id' => [
                    'required',
                    'integer',
                    'exists:master_rujukan,id',
                ],
                'tanggal_rujukan' => ['required', 'date'],
                'status_rujukan' => [
                    'required',
                    'in:direncanakan,dirujuk,selesai,dibatalkan',
                ],
                'alasan_rujukan' => ['required', 'string'],
            ]);
        }

        // 5. Pastikan diagnosa yang dipilih masih aktif.
        if (
            Diagnosa::whereIn('id', $data['diagnosa_ids'])
            ->where('is_active', true)
            ->count() !== count($data['diagnosa_ids'])
        ) {
            throw ValidationException::withMessages([
                'diagnosa_ids' => 'Ada diagnosa yang tidak aktif atau tidak valid.',
            ]);
        }

        // 6. Pastikan tindakan yang dipilih masih aktif.
        if (
            Tindakan::whereIn('id', $data['tindakan_ids'])
            ->where('is_active', true)
            ->count() !== count($data['tindakan_ids'])
        ) {
            throw ValidationException::withMessages([
                'tindakan_ids' => 'Ada tindakan yang tidak aktif atau tidak valid.',
            ]);
        }

        // 7. Pastikan obat yang dipilih masih aktif.
        if (
            $perluObat &&
            Obat::whereIn('id', $obatIds)
            ->where('is_active', true)
            ->count() !== count($obatIds)
        ) {
            throw ValidationException::withMessages([
                'obat_ids' => 'Ada obat yang tidak aktif atau tidak valid.',
            ]);
        }

        // 8. Pastikan fasilitas rujukan masih aktif.
        if (
            $perluRujukan &&
            !MasterRujukan::where('id', $data['rujukan_id'])
                ->where('is_active', true)
                ->exists()
        ) {
            throw ValidationException::withMessages([
                'rujukan_id' => 'Fasilitas rujukan tidak aktif atau tidak valid.',
            ]);
        }

        // 9. Validasi jumlah dan detail setiap obat.
        if ($perluObat) {
            foreach ($obatIds as $obatId) {
                $jumlah = (int) ($data['jumlah'][$obatId] ?? 0);

                if ($jumlah < 1) {
                    throw ValidationException::withMessages([
                        'jumlah' => 'Jumlah setiap obat wajib diisi minimal 1.',
                    ]);
                }

                if (empty($data['dosis'][$obatId])) {
                    throw ValidationException::withMessages([
                        'dosis' => 'Dosis setiap obat wajib diisi.',
                    ]);
                }

                if (empty($data['frekuensi'][$obatId])) {
                    throw ValidationException::withMessages([
                        'frekuensi' => 'Frekuensi setiap obat wajib diisi.',
                    ]);
                }

                if (empty($data['aturan_pakai'][$obatId])) {
                    throw ValidationException::withMessages([
                        'aturan_pakai' => 'Aturan pakai setiap obat wajib diisi.',
                    ]);
                }
            }
        }

        // 10. Simpan semua data dalam satu transaksi database.
        DB::transaction(function () use (
            $kunjungan,
            $data,
            $perluRujukan,
            $perluObat,
            $obatIds
        ) {
            $kunjungan = Kunjungan::whereKey($kunjungan->id)
                ->lockForUpdate()
                ->firstOrFail();

            // Cek ulang status kunjungan di dalam transaksi.
            if (in_array($kunjungan->status, ['selesai', 'dibatalkan'], true)) {
                throw ValidationException::withMessages([
                    'kunjungan' => 'Kunjungan sudah ditutup.',
                ]);
            }

            // Cegah perubahan resep jika stok obat sudah pernah dikeluarkan.
            $sudahDikeluarkan = MutasiStok::where('jenis', 'keluar')
                ->whereHas('resepDetail', function ($query) use ($kunjungan) {
                    $query->whereHas('resep', function ($q) use ($kunjungan) {
                        $q->where('kunjungan_id', $kunjungan->id);
                    });
                })
                ->exists();

            if ($sudahDikeluarkan) {
                throw ValidationException::withMessages([
                    'obat_ids' => 'Resep kunjungan ini sudah diproses. '
                        . 'Perubahan resep harus dilakukan melalui prosedur koreksi yang tersedia.',
                ]);
            }

            // 11. Simpan pemeriksaan fisik.
            Pemeriksaan::updateOrCreate(
                [
                    'kunjungan_id' => $kunjungan->id,
                ],
                [
                    'tekanan_darah' => $data['tekanan_darah'],
                    'suhu' => $data['suhu'],
                    'nadi' => $data['nadi'] ?? null,
                    'pernapasan' => $data['pernapasan'] ?? null,
                    'berat_badan' => $data['berat_badan'] ?? null,
                    'tinggi_badan' => $data['tinggi_badan'] ?? null,
                    'pemeriksaan_fisik' => $data['pemeriksaan_fisik'] ?? null,
                    'catatan' => $data['catatan_pemeriksaan'] ?? null,
                ]
            );

            // 12. Simpan diagnosa beserta catatan pivot.
            $diagnosaSync = [];

            foreach ($data['diagnosa_ids'] as $id) {
                $diagnosaSync[$id] = [
                    'catatan' => $data['catatan_diagnosa'] ?? null,
                ];
            }

            $kunjungan->diagnosas()->sync($diagnosaSync);

            // 13. Simpan tindakan beserta catatan pivot.
            $tindakanSync = [];

            foreach ($data['tindakan_ids'] as $id) {
                $tindakanSync[$id] = [
                    'catatan' => $data['catatan_tindakan'] ?? null,
                ];
            }

            $kunjungan->tindakans()->sync($tindakanSync);

            // 14. Simpan status kebutuhan pelayanan.
            // Obat dan rujukan tidak saling meniadakan.
            $kunjungan->perlu_rujukan = $perluRujukan;
            $kunjungan->perlu_obat = $perluObat;
            $kunjungan->status = 'diperiksa';
            $kunjungan->save();

            // 15. Simpan atau hapus data rujukan secara independen.
            if ($perluRujukan) {
                Rujukan::updateOrCreate(
                    [
                        'kunjungan_id' => $kunjungan->id,
                    ],
                    [
                        'rujukan_id' => $data['rujukan_id'],
                        'tanggal_rujukan' => $data['tanggal_rujukan'],
                        'status' => $data['status_rujukan'],
                        'alasan' => $data['alasan_rujukan'],
                        'keterangan' => $data['keterangan_rujukan'] ?? null,
                    ]
                );
            } else {
                $kunjungan->rujukan()->delete();
            }

            // 16. Simpan resep secara independen dari rujukan.
            if ($perluObat) {
                $resep = Resep::updateOrCreate(
                    [
                        'kunjungan_id' => $kunjungan->id,
                    ],
                    [
                        'nomor_resep' => $kunjungan->resep?->nomor_resep
                            ?? 'RSP-' . now()->format('YmdHis')
                            . '-' . random_int(100, 999),
                        'catatan' => $data['catatan_resep'] ?? null,
                    ]
                );

                // Hapus detail lama sebelum membuat detail yang baru.
                $resep->details()->delete();

                foreach ($obatIds as $obatId) {
                    $resep->details()->create([
                        'obat_id' => $obatId,
                        'jumlah' => (int) $data['jumlah'][$obatId],
                        'dosis' => $data['dosis'][$obatId],
                        'frekuensi' => $data['frekuensi'][$obatId],
                        'aturan_pakai' => $data['aturan_pakai'][$obatId],
                        'keterangan' => $data['keterangan'][$obatId] ?? null,
                    ]);
                }
            } elseif ($kunjungan->resep) {
                // Tidak ada obat yang dipilih: hapus detail resep lama.
                $kunjungan->resep->details()->delete();
            }

            // 17. Keluarkan stok obat secara atomik.
            if ($perluObat) {
                $resep = $kunjungan->resep()
                    ->with('details')
                    ->firstOrFail();

                foreach ($resep->details as $detail) {
                    // Jangan mengeluarkan stok dua kali untuk detail yang sama.
                    $sudahAdaMutasi = MutasiStok::where(
                        'resep_detail_id',
                        $detail->id
                    )
                        ->where('jenis', 'keluar')
                        ->exists();

                    if ($sudahAdaMutasi) {
                        continue;
                    }

                    // Kunci data obat selama transaksi untuk menghindari
                    // perubahan stok bersamaan.
                    $obat = Obat::whereKey($detail->obat_id)
                        ->lockForUpdate()
                        ->first();

                    if (!$obat) {
                        throw ValidationException::withMessages([
                            'obat_ids' => 'Data obat tidak ditemukan.',
                        ]);
                    }

                    if ($obat->stok < $detail->jumlah) {
                        throw ValidationException::withMessages([
                            'obat_ids' => "Stok {$obat->nama} tidak mencukupi. "
                                . "Stok tersedia: {$obat->stok}.",
                        ]);
                    }

                    $stokSebelum = $obat->stok;
                    $obat->stok = $stokSebelum - $detail->jumlah;
                    $obat->save();

                    // Catat mutasi pengeluaran stok.
                    MutasiStok::create([
                        'obat_id' => $obat->id,
                        'resep_detail_id' => $detail->id,
                        'jenis' => 'keluar',
                        'jumlah' => $detail->jumlah,
                        'stok_sebelum' => $stokSebelum,
                        'stok_sesudah' => $obat->stok,
                        'keterangan' => 'Pengeluaran obat untuk kunjungan '
                            . $kunjungan->kode_kunjungan,
                        'user_id' => Auth::id(),
                    ]);
                }
            }

            // 18. Selesaikan kunjungan.
            $kunjungan->status = 'selesai';
            $kunjungan->save();
        }, 3);

        // 19. Kembali ke halaman detail kunjungan.
        return redirect()
            ->route('kunjungan.show', $kunjungan)
            ->with(
                'success',
                'Pemeriksaan dan seluruh data pelayanan berhasil disimpan. '
                    . 'Kunjungan telah selesai.'
            );
    }

    public function edit(Kunjungan $kunjungan)
    {
        abort_unless(Auth::user()?->role === 'admin', 403);

        if ($kunjungan->status === 'dibatalkan') {
            return redirect()
                ->route('kunjungan.show', $kunjungan)
                ->with('error', 'Kunjungan yang dibatalkan tidak dapat diedit.');
        }

        $kunjungan->load([
            'santri',
            'pemeriksaan',
            'diagnosas',
            'tindakans',
            'resep.details.obat',
            'rujukan',
        ]);

        $diagnosaIdsLama = $kunjungan->diagnosas->pluck('id');
        $tindakanIdsLama = $kunjungan->tindakans->pluck('id');

        $diagnosas = Diagnosa::where('is_active', true)
            ->orWhereIn('id', $diagnosaIdsLama)
            ->orderBy('nama')
            ->get();

        $tindakans = Tindakan::where('is_active', true)
            ->orWhereIn('id', $tindakanIdsLama)
            ->orderBy('nama')
            ->get();

        return view('pemeriksaan-terpadu.edit', compact(
            'kunjungan',
            'diagnosas',
            'tindakans'
        ));
    }

    public function update(Request $request, Kunjungan $kunjungan)
    {
        abort_unless(Auth::user()?->role === 'admin', 403);

        $data = $request->validate([
            'tekanan_darah' => ['required', 'string', 'max:20'],
            'suhu' => ['required', 'numeric', 'between:30,45'],
            'nadi' => ['nullable', 'integer', 'min:0', 'max:250'],
            'pernapasan' => ['nullable', 'integer', 'min:0', 'max:100'],
            'berat_badan' => ['nullable', 'numeric', 'min:0', 'max:300'],
            'tinggi_badan' => ['nullable', 'numeric', 'min:0', 'max:250'],
            'pemeriksaan_fisik' => ['nullable', 'string'],
            'catatan_pemeriksaan' => ['nullable', 'string'],

            'diagnosa_ids' => ['required', 'array', 'min:1'],
            'diagnosa_ids.*' => [
                'required',
                'integer',
                'distinct',
                'exists:diagnosas,id',
            ],
            'catatan_diagnosa' => ['nullable', 'string'],

            'tindakan_ids' => ['required', 'array', 'min:1'],
            'tindakan_ids.*' => [
                'required',
                'integer',
                'distinct',
                'exists:tindakans,id',
            ],
            'catatan_tindakan' => ['nullable', 'string'],
        ]);

        DB::transaction(function () use ($kunjungan, $data) {
            $terkunci = Kunjungan::whereKey($kunjungan->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($terkunci->status === 'dibatalkan') {
                throw ValidationException::withMessages([
                    'kunjungan' => 'Kunjungan yang dibatalkan tidak dapat diedit.',
                ]);
            }

            // 1. Perbarui pemeriksaan fisik tanpa mengubah status kunjungan.
            Pemeriksaan::updateOrCreate(
                ['kunjungan_id' => $terkunci->id],
                [
                    'tekanan_darah' => $data['tekanan_darah'],
                    'suhu' => $data['suhu'],
                    'nadi' => $data['nadi'] ?? null,
                    'pernapasan' => $data['pernapasan'] ?? null,
                    'berat_badan' => $data['berat_badan'] ?? null,
                    'tinggi_badan' => $data['tinggi_badan'] ?? null,
                    'pemeriksaan_fisik' => $data['pemeriksaan_fisik'] ?? null,
                    'catatan' => $data['catatan_pemeriksaan'] ?? null,
                ]
            );

            // 2. Perbarui diagnosis beserta catatan pivot.
            $diagnosaSync = [];

            foreach ($data['diagnosa_ids'] as $id) {
                $diagnosaSync[$id] = [
                    'catatan' => $data['catatan_diagnosa'] ?? null,
                ];
            }

            $terkunci->diagnosas()->sync($diagnosaSync);

            // 3. Perbarui tindakan beserta catatan pivot.
            $tindakanSync = [];

            foreach ($data['tindakan_ids'] as $id) {
                $tindakanSync[$id] = [
                    'catatan' => $data['catatan_tindakan'] ?? null,
                ];
            }

            $terkunci->tindakans()->sync($tindakanSync);

            // Status selesai tetap selesai; status lainnya tidak diubah.
        }, 3);

        return redirect()
            ->route('kunjungan.show', $kunjungan)
            ->with('success', 'Pemeriksaan berhasil diperbarui.');
    }
}
