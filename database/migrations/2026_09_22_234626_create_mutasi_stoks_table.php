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
        Schema::create('mutasi_stoks', function (Blueprint $table) {
            $table->id();

            $table->foreignId('obat_id')
                ->constrained('obats')
                ->cascadeOnDelete();

            $table->foreignId('resep_detail_id')
                ->nullable()
                ->constrained('resep_details')
                ->nullOnDelete();

            $table->enum('jenis', [
                'masuk',
                'keluar',
                'penyesuaian',
            ]);

            $table->unsignedInteger('jumlah');

            $table->unsignedInteger('stok_sebelum');

            $table->unsignedInteger('stok_sesudah');

            $table->text('keterangan')->nullable();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutasi_stoks');
    }
};
