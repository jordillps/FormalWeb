<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LegalPageTranslation>
 */
class LegalPageTranslationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->unique()->sentence($nbWords = 8, $variableNbWords = true);
        return [
            'title' => $title,
            'body' => $this->faker->text($maxNbChars = 400),
        ];
    }
}
