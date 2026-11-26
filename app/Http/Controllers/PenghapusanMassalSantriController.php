<?php

namespace App\Http\Controllers;

use App\Imports\DaftarHapusSantriImport;
use App\Models\Santri;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class PenghapusanMassalSantriController extends Controller
{
    private const SESSION_KEY = 'penghapusan_massal_santri';

    public function index(): View
    {
        $nomorInduk = session(self::SESSION_KEY, []);

        $santriDitemukan = Santri::query()
            ->whereIn('nomor_induk', $nomorInduk)
            ->orderBy('nama')
            ->get(['id', 'nomor_induk', 'nama', 'kamar', 'status']);

        $nomorDitemukan = $santriDitemukan
            ->pluck('nomor_induk')
            ->map(fn ($nomor) => (string) $nomor)
            ->all();

        $nomorTidakDitemukan = array_values(
            array_diff($nomorInduk, $nomorDitemukan)
        );

        return view('santri.penghapusan-massal', [
            'santriDitemukan' => $santriDitemukan,
            'nomorTidakDitemukan' => $nomorTidakDitemukan,
            'sudahUpload' => !empty($nomorInduk),
        ]);
    }

    public function upload(Request $request): RedirectResponse
    {
        $request->validate([
            'file' => [
                'required',
                'file',
                'mimes:xlsx,xls,csv',
                'max:2048',
            ],
        ], [
            'file.required' => 'Silakan pilih file Excel terlebih dahulu.',
            'file.mimes' => 'File harus berformat XLSX, XLS, atau CSV.',
            'file.max' => 'Ukuran file maksimal 2 MB.',
        ]);

        try {
            $import = new DaftarHapusSantriImport();

            Excel::import($import, $request->file('file'));

            $nomorInduk = $import->nomorInduk;

            if (count($nomorInduk) === 0) {
                return back()->withErrors([
                    'file' => 'Tidak ditemukan nomor_induk pada file.',
                ]);
            }

            if (count($nomorInduk) > 500) {
                return back()->withErrors([
                    'file' => 'Maksimal 500 nomor induk dalam satu proses.',
                ]);
            }

            session([self::SESSION_KEY => $nomorInduk]);

            return redirect()
                ->route('santri.penghapusan-massal.index')
                ->with('success', 'File berhasil dibaca. Periksa pratinjau sebelum menghapus data.');
        } catch (Throwable $e) {
            report($e);

            return back()->withErrors([
                'file' => 'File gagal dibaca. Periksa format dan isi file Excel Anda.',
            ]);
        }
    }

    public function hapus(Request $request): RedirectResponse
    {
        $request->validate([
            'konfirmasi' => ['required', 'accepted'],
        ], [
            'konfirmasi.accepted' => 'Anda harus menyetujui penghapusan permanen.',
        ]);

        $nomorInduk = session(self::SESSION_KEY, []);

        if (empty($nomorInduk)) {
            return redirect()
                ->route('santri.penghapusan-massal.index')
                ->withErrors([
                    'file' => 'Pratinjau tidak tersedia. Silakan unggah ulang file Excel.',
                ]);
        }

        try {
            $jumlahDihapus = DB::transaction(function () use ($nomorInduk) {
                $daftarSantri = Santri::query()
                    ->whereIn('nomor_induk', $nomorInduk)
                    ->lockForUpdate()
                    ->get(['id', 'nomor_induk']);

                foreach ($daftarSantri as $santri) {
                    $kunjunganIds = DB::table('kunjungans')
                        ->where('santri_id', $santri->id)
                        ->pluck('id');

                    $resepIds = DB::table('reseps')
                        ->whereIn('kunjungan_id', $kunjunganIds)
                        ->pluck('id');

                    // Hapus riwayat koreksi resep terlebih dahulu.
                    DB::table('koreksi_reseps')
                        ->whereIn('resep_id', $resepIds)
                        ->delete();

                    // Hapus data pemeriksaan dan rujukan.
                    DB::table('pemeriksaans')
                        ->whereIn('kunjungan_id', $kunjunganIds)
                        ->delete();

                    DB::table('rujukans')
                        ->whereIn('kunjungan_id', $kunjunganIds)
                        ->delete();

                    // Hapus hubungan diagnosis dan tindakan,
                    // bukan data master diagnosis atau tindakan.
                    DB::table('kunjungan_diagnosa')
                        ->whereIn('kunjungan_id', $kunjunganIds)
                        ->delete();

                    DB::table('kunjungan_tindakan')
                        ->whereIn('kunjungan_id', $kunjunganIds)
                        ->delete();

                    // Hapus detail resep. Relasi mutasi stok akan
                    // mengosongkan resep_detail_id melalui nullOnDelete().
                    DB::table('resep_details')
                        ->whereIn('resep_id', $resepIds)
                        ->delete();

                    DB::table('reseps')
                        ->whereIn('kunjungan_id', $kunjunganIds)
                        ->delete();

                    // Hapus kunjungan sebelum santri.
                    DB::table('kunjungans')
                        ->where('santri_id', $santri->id)
                        ->delete();

                    // Hapus alergi khusus milik santri.
                    DB::table('alergis')
                        ->where('santri_id', $santri->id)
                        ->delete();

                    // Penghapusan permanen data santri.
                    $santri->delete();
                }

                return $daftarSantri->count();
            });

            session()->forget(self::SESSION_KEY);

            return redirect()
                ->route('santri.index')
                ->with(
                    'success',
                    "{$jumlahDihapus} data santri beserta rekam medis terkait berhasil dihapus permanen."
                );
        } catch (Throwable $e) {
            report($e);

            return redirect()
                ->route('santri.penghapusan-massal.index')
                ->withErrors([
                    'file' => 'Penghapusan gagal. Transaksi dibatalkan. Periksa log aplikasi untuk mengetahui penyebabnya.',
                ]);
        }
    }

    public function batal(): RedirectResponse
    {
        session()->forget(self::SESSION_KEY);

        return redirect()
            ->route('santri.penghapusan-massal.index')
            ->with('success', 'Pratinjau penghapusan telah dibatalkan.');
    }
}
