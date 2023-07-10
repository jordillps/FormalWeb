<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostTranslation;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::factory()->count(5)->create()->each(function (Post $post) {
            PostTranslation::factory()->count(1)->create(['post_id' => $post->id, 'locale' => 'es']);
            PostTranslation::factory()->count(1)->create(['post_id' => $post->id,'locale' => 'en']);
            PostTranslation::factory()->count(1)->create(['post_id' => $post->id,'locale' => 'ca']);
        });

    }
}
