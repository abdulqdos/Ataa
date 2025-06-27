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

        $title = $this->faker->randomElement([
            'تم قبولك في الفرصة',
            'تم رفض طلبك',
            'موعد الفرصة اقترب',
        ]);

        $message = match ($title) {
            'تم قبولك في الفرصة' => $this->faker->randomElement([
                'لقد تم قبولك رسميًا في الفرصة التطوعية، نتمنى لك التوفيق.',
                'نبارك لك قبولك في هذه الفرصة، سيتم التواصل معك قريبًا.',
                'تمت الموافقة على مشاركتك، الرجاء متابعة التعليمات.',
            ]),

            'تم رفض طلبك' => $this->faker->randomElement([
                'نأسف، لم يتم قبولك في هذه الفرصة. حاول التقديم على فرص أخرى.',
                'تم رفض طلبك هذه المرة، نتمنى لك التوفيق في فرص قادمة.',
                'لم يتم اختيارك لهذه الفرصة، لكن المجال مازال مفتوحًا.',
            ]),

            'موعد الفرصة اقترب' => $this->faker->randomElement([
                'تبقّى يومان على بدء الفرصة، كن مستعدًا وانطلق!',
                'نذكّرك أن موعد انطلاق الفرصة سيكون قريبًا، تأكد من جاهزيتك.',
                'الفرصة تبدأ قريبًا، تأكد من تفاصيل المكان والزمان.',
            ]),
        };

        return [
            'title' => $title,
            'message' => $message,
            'user_id' => User::factory(),
        ];
    }
}
