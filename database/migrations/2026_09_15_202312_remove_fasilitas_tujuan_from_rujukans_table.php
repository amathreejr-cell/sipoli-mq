<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rujukans', function (Blueprint $table) {
            $table->dropColumn('fasilitas_tujuan');
        });
    }

    public function down(): void
    {
        Schema::table('rujukans', function (Blueprint $table) {
            $table->string('fasilitas_tujuan', 200);
        });
    }
};