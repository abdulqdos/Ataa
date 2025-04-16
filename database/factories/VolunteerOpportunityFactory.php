<?php

namespace Database\Factories;

use App\Models\Opportunity;
use App\Models\Volunteer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VolunteerOpportunity>
 */
class VolunteerOpportunityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'opportunity_id' => Opportunity::factory(),
            'volunteer_id' => Volunteer::factory(),
        ];
    }
}
