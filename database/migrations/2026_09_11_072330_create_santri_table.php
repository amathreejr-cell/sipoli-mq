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
        Schema::create('santri', function (Blueprint $table) {
            $table->id();

            $table->string('nomor_induk', 50)->unique();
            $table->string('nama', 150);

            $table->enum('jenis_kelamin', ['L', 'P']);

            $table->date('tanggal_lahir')->nullable();

            $table->text('alamat')->nullable();
            $table->string('no_hp', 20)->nullable();

            $table->foreignId('kamar_id')
                ->constrained('kamar')
                ->restrictOnDelete();

            $table->foreignId('angkatan_id')
                ->constrained('angkatan')
                ->restrictOnDelete();

            $table->foreignId('wali_santri_id')
                ->nullable()
                ->constrained('wali_santri')
                ->nullOnDelete();

            $table->enum('status', ['aktif', 'nonaktif'])
                ->default('aktif');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('santri');
    }
};
