<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('santri', function (Blueprint $table) {
            // Hapus relasi lama
            $table->dropForeign(['kamar_id']);
            $table->dropForeign(['angkatan_id']);
            $table->dropForeign(['wali_santri_id']);

            $table->dropColumn([
                'kamar_id',
                'angkatan_id',
                'wali_santri_id',
            ]);

            // Tambahkan atribut baru
            $table->string('tempat_lahir', 100)->nullable()->after('nama');
            $table->string('kamar', 50)->nullable()->after('tanggal_lahir');
            $table->string('sekolah', 150)->nullable()->after('kamar');
            $table->string('kelas', 50)->nullable()->after('sekolah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('santri', function (Blueprint $table) {
            // Hapus atribut baru
            $table->dropColumn([
                'tempat_lahir',
                'kamar',
                'sekolah',
                'kelas',
            ]);

            // Kembalikan kolom relasi lama
            $table->foreignId('kamar_id')
                ->nullable()
                ->constrained('kamar')
                ->nullOnDelete();

            $table->foreignId('angkatan_id')
                ->nullable()
                ->constrained('angkatan')
                ->restrictOnDelete();

            $table->foreignId('wali_santri_id')
                ->nullable()
                ->constrained('wali_santri')
                ->nullOnDelete();
        });
    }
};