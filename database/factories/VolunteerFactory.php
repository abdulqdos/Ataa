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
            'age' => $this->faker->numberBetween(18, 30),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'phone_number' => $this->faker->numerify('09#########'),
            'bio' => $this->faker->randomElement([
                'طالب جامعي مهتم بالمجال الإنساني والتنموي.',
                'شغوف بالعمل التطوعي وخدمة المجتمع.',
                'أحب المشاركة في المبادرات البيئية والاجتماعية.',
                'أهدف لاكتساب الخبرات من خلال الأنشطة التطوعية.',
                'أشارك بانتظام في حملات التوعية والعمل الخيري.',
                'أعمل على دعم الفئات المحتاجة من خلال الجهود الفردية.',
                'أؤمن بأن التغيير يبدأ من المبادرة المجتمعية.',
                'أنشط في مجال التعليم والتدريب التطوعي.',
                'أهتم بتنمية مهاراتي من خلال التطوع الفعّال.',
                'منخرط في الأنشطة الشبابية والمجتمعية منذ سنوات.'
            ]),
            'eval_avg' => rand(3,5),
            'user_id' => User::factory(),
        ];
    }
}
