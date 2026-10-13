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
        Schema::create('kunjungans', function (Blueprint $table) {
            $table->id();

            $table->string('kode_kunjungan', 30)->unique();

            $table->foreignId('santri_id')
                ->constrained('santri')
                ->restrictOnDelete();

            $table->foreignId('petugas_id')
                ->constrained('users')
                ->restrictOnDelete();

            $table->date('tanggal');
            $table->time('waktu');

            $table->text('keluhan');

            $table->enum('status', [
                'menunggu',
                'diperiksa',
                'selesai',
                'dibatalkan'
            ])->default('menunggu');

            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kunjungans');
    }
};
