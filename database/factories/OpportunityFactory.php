<?php

namespace Database\Factories;

use App\Models\Organization;
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
        return [
            'title' => $this->faker->firstName(),
            'description' =>  str(fake()->realText(120)),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'status' => $this->faker->randomElement(['upcoming', 'active', 'completed']),
            'location' => $this->faker->city(),
            'location_url' => "https://www.google.com/maps/search/?api=1&query=" . fake()->latitude . "," . fake()->longitude,
            'count' => $this->faker->numberBetween(20, 100),
            'organization_id' => Organization::factory(),
        ];
    }
}
