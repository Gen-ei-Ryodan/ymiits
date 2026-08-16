<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('homes', function (Blueprint $table) {
            // Periksa dulu apakah kolom sudah ada untuk mencegah error
            if (! Schema::hasColumn('homes', 'foto_1')) {
                $table->string('foto_1')->nullable();
            }

            if (! Schema::hasColumn('homes', 'foto_2')) {
                $table->string('foto_2')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('homes', function (Blueprint $table) {
            $table->dropColumn(['foto_1', 'foto_2']);
        });
    }
};
