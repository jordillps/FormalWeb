<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Header;

class HeaderTranslationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'header_id' => Header::all()->random()->id,
            'title' => $this->faker->text,
            'text' => $this->faker->text,
        ];
    }
}
