<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SpeakerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName(),
            'surname' => $this->faker->lastName(),
            'title' => $this->faker->jobTitle(),
            'job_type' => $this->faker->word(),
            'is_special_guest' => $this->faker->boolean(),
            'social_media' => json_encode([
                'twitter' => $this->faker->url(),
                'linkedin' => $this->faker->url(),
                'facebook' => $this->faker->url(),
            ]),
        ];
    }
}
