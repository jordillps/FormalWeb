<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\ProjectTranslation;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::factory()->count(5)->create()->each(function (Project $project) {
            ProjectTranslation::factory()->count(1)->create(['project_id' => $project->id, 'locale' => 'es']);
            ProjectTranslation::factory()->count(1)->create(['project_id' => $project->id,'locale' => 'en']);
            ProjectTranslation::factory()->count(1)->create(['project_id' => $project->id,'locale' => 'ca']);
        });
    }
}
