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
        Schema::table('rujukans', function (Blueprint $table) {
            $table->foreignId('rujukan_id')
                ->nullable()
                ->after('kunjungan_id')
                ->constrained('master_rujukan')
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rujukans', function (Blueprint $table) {
            $table->dropForeign(['rujukan_id']);
            $table->dropColumn('rujukan_id');
        });
    }
};