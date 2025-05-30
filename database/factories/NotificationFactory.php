<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->randomElement([
                'تم قبولك في الفرصة',
                'تم رفض طلبك',
                'موعد الفرصة اقترب',
                'تم تعديل بيانات الفرصة',
                'شكراً لمشاركتك'
            ]),
            'message' => $this->faker->realText(100),
            'user_id' => User::factory(),
        ];
    }
}
