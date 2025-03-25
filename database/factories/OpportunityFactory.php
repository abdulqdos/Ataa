<?php

namespace Database\Factories;

use App\Models\Organization;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Opportunity>
 */
class OpportunityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = Carbon::now()->addDays(rand(0, 1));
        $endDate = $startDate->copy()->addDays(rand(1, 20));
        return [
            'title' => $this->faker->firstName(),
            'description' =>  str(fake()->realText(120)),
            'start_date' =>$startDate,
            'end_date' => $endDate,
            'status' => $this->faker->randomElement(['upcoming', 'active', 'completed']),
            'location' => $this->faker->city(),
            'location_url' => "https://www.google.com/maps/search/?api=1&query=" . fake()->latitude . "," . fake()->longitude,
            'count' => $this->faker->numberBetween(20, 100),
            'organization_id' => Organization::factory(),
        ];
    }
}
