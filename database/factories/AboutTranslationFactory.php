<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\About;

class AboutTranslationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'about_id' => About::all()->random()->id,
            'profession' => $this->faker->jobTitle,
            'about_me' => $this->faker->text,
        ];
    }
}
