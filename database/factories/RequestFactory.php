<?php

namespace Database\Factories;

use App\Models\Opportunity;
use App\Models\Volunteer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Request>
 */
class RequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reason' => $this->faker->realText(30),
            'volunteer_id' => Volunteer::factory(),
            'opportunity_id' => Opportunity::factory(),
        ];
    }
}
