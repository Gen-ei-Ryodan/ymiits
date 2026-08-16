<?php

namespace Database\Seeders;

use App\Models\NewsSource;
use Illuminate\Database\Seeder;

class NewsSourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NewsSource::create([
            'name' => 'Internal',
            'url' => null,
            'api_key' => null,
            'is_active' => true,
        ]);

        NewsSource::create([
            'name' => 'ITSedekah',
            'url' => 'https://itsedekah.id/news_api.php',
            'api_key' => null,
            'is_active' => true,
        ]);
    }
} 