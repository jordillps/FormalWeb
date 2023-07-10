<?php

namespace Database\Factories;
use Illuminate\Support\Str;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CategoryTranslation>
 */
class CategoryTranslationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->unique()->sentence($nbWords = 2, $variableNbWords = true);
        $url =  Str::slug($name);
        return [
            'name' => $name,
            'url' => $url,
        ];
    }
}
