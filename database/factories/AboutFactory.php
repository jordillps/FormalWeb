<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Page;

class AboutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'html' => $this->faker->numberBetween($min = 1, $max = 100),
            'css' => $this->faker->numberBetween($min = 1, $max = 100),
            'php' => $this->faker->numberBetween($min = 1, $max = 100),
            'javascript' => $this->faker->numberBetween($min = 1, $max = 100)
        ];
    }
}
