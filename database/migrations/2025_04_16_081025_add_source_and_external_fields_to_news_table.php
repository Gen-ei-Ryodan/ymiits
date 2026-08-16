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
        Schema::table('news', function (Blueprint $table) {
            $table->foreignId('source_id')->nullable()->after('author')->constrained('news_sources');
            $table->string('external_id')->nullable()->after('source_id');
            $table->string('url')->nullable()->after('external_id');
            $table->timestamp('published_at')->nullable()->after('url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropForeign(['source_id']);
            $table->dropColumn(['source_id', 'external_id', 'url', 'published_at']);
        });
    }
};
