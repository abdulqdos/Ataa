<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Sector;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Organization>
 */
class OrganizationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'phone_number' => $this->faker->phoneNumber(),
            'contact_email' => $this->faker->unique()->safeEmail(),
            'bio'  => str(fake()->realText(120)),
            'city_id' => City::factory(),
            'sector_id' => Sector::factory(),
            'user_id' => User::factory(),
        ];
    }
}
