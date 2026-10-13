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
        Schema::create('resep_details', function (Blueprint $table) {
            $table->id();

            $table->foreignId('resep_id')
                ->constrained('reseps')
                ->restrictOnDelete();

            $table->foreignId('obat_id')
                ->constrained('obats')
                ->restrictOnDelete();

            $table->unsignedInteger('jumlah');

            $table->string('dosis', 100);
            $table->string('frekuensi', 100);
            $table->string('aturan_pakai', 150);

            $table->text('keterangan')->nullable();

            $table->timestamps();

            $table->unique([
                'resep_id',
                'obat_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resep_details');
    }
};
