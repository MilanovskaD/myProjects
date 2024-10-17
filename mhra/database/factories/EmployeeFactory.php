<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'job_title' => $this->faker->jobTitle(),
            'name' => $this->faker->firstName(),
            'surname' => $this->faker->lastName(),
            'short_bio' => $this->faker->paragraph(),
            'social_media' => json_encode([
                'twitter' => $this->faker->url(),
                'linkedin' => $this->faker->url(),
                'facebook' => $this->faker->url(),
            ]),
        ];
    }
}
