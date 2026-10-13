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
        Schema::create('rujukans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('kunjungan_id')
                ->unique()
                ->constrained('kunjungans')
                ->restrictOnDelete();

            $table->date('tanggal_rujukan');

            $table->string('fasilitas_tujuan', 200);

            $table->text('alasan');

            $table->text('keterangan')->nullable();

            $table->enum('status', [
                'direncanakan',
                'dirujuk',
                'selesai',
                'dibatalkan'
            ])->default('direncanakan');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rujukans');
    }
};
