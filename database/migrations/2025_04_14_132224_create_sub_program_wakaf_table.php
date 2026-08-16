<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_program_wakaf', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_wakaf_id')
                  ->constrained('program_wakaf')
                  ->onDelete('cascade')
                  ->name('fk_sub_program_wakaf');
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_program_wakaf');
    }
};
