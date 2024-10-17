<?php

namespace Database\Factories;

use App\Models\Agenda;
use App\Models\AnnualConference;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agenda>
 */
class AgendaFactory extends Factory
{
    protected $model = Agenda::class;

    public function definition()
    {
        $details = [];
        $numItems = rand(2, 4);

        for ($i = 0; $i < $numItems; $i++) {
            $details[] = [
                'hour' => $this->faker->time('H:i'),
                'title' => $this->faker->sentence(3),
                'description' => $this->faker->paragraph,
            ];
        }

        $isEvent = $this->faker->boolean;

        return [
            'details' => json_encode($details),
            'event_id' => $isEvent ? Event::factory() : null,
            'annual_conference_id' => !$isEvent ? AnnualConference::factory() : null,
        ];
    }
}
