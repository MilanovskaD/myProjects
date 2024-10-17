<?php

namespace Database\Factories;

use App\Models\AnnualConference;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'event_id' => $this->faker->boolean ? Event::factory() : null,
            'annual_conference_id' => $this->faker->boolean ? AnnualConference::factory() : null,
            'price_per_person' => $this->faker->numberBetween(50, 200),
            'price_per_company' => $this->faker->numberBetween(500, 2000),
        ];
    }
}
