<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;



class PostTranslationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->unique()->sentence($nbWords = 8, $variableNbWords = true);
        return [
            'title' => $title,
            'excerpt' => $this->faker->text,
            'iframe' => $this->faker->text,
            'body' => $this->faker->text($maxNbChars = 400),
        ];
    }
}
