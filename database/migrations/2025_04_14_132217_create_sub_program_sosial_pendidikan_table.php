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
        Schema::create('sub_program_sosial_pendidikan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_sosial_pendidikan_id')
                  ->constrained('program_sosial_pendidikan')
                  ->onDelete('cascade')
                  ->name('fk_sub_program_sosial_pendidikan');
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
        Schema::dropIfExists('sub_program_sosial_pendidikan');
    }
};
