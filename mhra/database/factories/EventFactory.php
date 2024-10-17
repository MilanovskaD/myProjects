<?php

namespace Database\Factories;

use App\Models\Speaker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'theme' => $this->faker->word(),
            'description' => $this->faker->paragraph(),
            'objective' => $this->faker->paragraph(),
            'date' => $this->faker->date(),
            'location' => $this->faker->city(),
            'speaker_id' => Speaker::factory(),
        ];
    }
}
