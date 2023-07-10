<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Page;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'icon' => $this->faker->randomElement(['ion-monitor', 'ion-code-working', 'ion-camera', 'ion-android-phone-portrait', 'ion-paintbrush','ion-stats-bars'])
        ];
    }
}
