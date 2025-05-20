<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sector>
 */
class SectorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'الصحة',
                'التعليم',
                'البيئة',
                'التنمية المجتمعية',
                'ريادة الأعمال',
                'التقنية',
                'الديني',
                'الثقافة والفنون',
                'الرياضة',
                'الإغاثة الإنسانية',
                'الطفولة',
                'حقوق الإنسان',
                'العمل الخيري'
            ]),
        ];
    }
}
