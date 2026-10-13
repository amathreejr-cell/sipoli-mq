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
        Schema::create('alergis', function (Blueprint $table) {
            $table->id();

            $table->foreignId('santri_id')
                ->constrained('santri')
                ->restrictOnDelete();

            $table->string('jenis', 50);
            $table->string('nama', 150);
            $table->string('reaksi', 150)->nullable();
            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alergis');
    }
};
