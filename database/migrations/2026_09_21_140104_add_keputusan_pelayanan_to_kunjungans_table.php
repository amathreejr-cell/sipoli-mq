<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kunjungans', function (Blueprint $table) {
            $table->boolean('perlu_rujukan')
                ->nullable()
                ->after('status');

            $table->boolean('perlu_obat')
                ->nullable()
                ->after('perlu_rujukan');
        });
    }

    public function down(): void
    {
        Schema::table('kunjungans', function (Blueprint $table) {
            $table->dropColumn([
                'perlu_rujukan',
                'perlu_obat',
            ]);
        });
    }
};