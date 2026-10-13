
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('koreksi_reseps', function (Blueprint $table) {
            $table->id();

            $table->foreignId('resep_id')
                ->constrained('reseps')
                ->restrictOnDelete();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->text('alasan');

            // Snapshot resep sebelum dan sesudah koreksi.
            $table->json('resep_sebelum');
            $table->json('resep_sesudah');

            $table->timestamp('dikoreksi_pada');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('koreksi_reseps');
    }
};
