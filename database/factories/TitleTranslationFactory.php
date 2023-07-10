<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Title;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TitleTranslation>
 */
class TitleTranslationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title_id' => Title::all()->random()->id,
            'title' => $this->faker->text,
            'text' => $this->faker->text,
        ];
    }
}
