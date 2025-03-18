<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use function Livewire\before;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Volunteer>
 */
class VolunteerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'age' => $this->faker->numberBetween(18, 99),
            'phone_number' => $this->faker->phoneNumber(),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'bio'  => str(fake()->realText(120)),
            'user_id' => User::factory(),
        ];
    }
}
