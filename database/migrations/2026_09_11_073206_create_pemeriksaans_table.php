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
        Schema::create('pemeriksaans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('kunjungan_id')
                ->unique()
                ->constrained('kunjungans')
                ->restrictOnDelete();

            $table->string('tekanan_darah', 20)->nullable();

            $table->decimal('suhu', 4, 1)->nullable();

            $table->unsignedSmallInteger('nadi')->nullable();

            $table->unsignedSmallInteger('pernapasan')->nullable();

            $table->decimal('berat_badan', 5, 2)->nullable();

            $table->decimal('tinggi_badan', 5, 2)->nullable();

            $table->text('pemeriksaan_fisik')->nullable();

            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaans');
    }
};
