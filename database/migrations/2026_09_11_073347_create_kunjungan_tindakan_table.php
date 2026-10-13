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
        Schema::create('kunjungan_tindakan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('kunjungan_id')
                ->constrained('kunjungans')
                ->restrictOnDelete();

            $table->foreignId('tindakan_id')
                ->constrained('tindakans')
                ->restrictOnDelete();

            $table->text('catatan')->nullable();

            $table->timestamps();

            $table->unique([
                'kunjungan_id',
                'tindakan_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kunjungan_tindakan');
    }
};
