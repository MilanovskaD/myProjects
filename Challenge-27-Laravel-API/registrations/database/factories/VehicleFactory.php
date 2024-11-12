<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = (new \Faker\Factory())::create();
        $faker->addProvider(new \Faker\Provider\FakeCar($faker));

        // To generate vehicle brand with its matching model
        $vehicle = $faker->vehicleArray;
        return [
            'brand' => $vehicle['brand'],
            'model' => $vehicle['model'],
            'plate_number' => $faker->vehicleRegistration,
            'insurance_date' => Carbon::now()->subDays(rand(30, 365)) //random date
        ];
    }
}
