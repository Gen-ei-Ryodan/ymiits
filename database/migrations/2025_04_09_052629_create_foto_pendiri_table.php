<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotoPendiriTable extends Migration
{
    public function up()
    {
        Schema::create('foto_pendiri', function (Blueprint $table) {
            $table->id();
            $table->string('foto'); // path ke file foto
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('foto_pendiri');
    }
}
