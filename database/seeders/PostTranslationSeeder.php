<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PostTranslation;

class PostTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        PostTranslation::factory()->count(5)->create();
    }
}
