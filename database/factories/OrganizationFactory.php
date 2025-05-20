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
            'name' => $this->faker->randomElement([
                'مؤسسة الخير للتنمية',
                'جمعية أيادي الرحمة',
                'منظمة بصمة شباب',
                'جمعية العطاء المستمر',
                'مؤسسة نور المستقبل',
                'منظمة بناء الإنسان',
                'جمعية إشراقة أمل',
                'مؤسسة رسالة حياة',
                'منظمة تكافل المجتمعية',
                'جمعية نبض التطوع'
            ]),
            'phone_number' => $this->faker->numerify('09#########'),
            'contact_email' => $this->faker->unique()->companyEmail(),
            'bio' => $this->faker->randomElement([
                'جمعية تهدف إلى تعزيز قيم العمل التطوعي وخدمة المجتمع.',
                'منظمة غير ربحية تعمل في مجالات التعليم والصحة والإغاثة.',
                'نسعى لبناء مجتمع واعي ومبادر من خلال برامج شبابية.',
                'مؤسسة تهتم بدعم الأسر المحتاجة وتحقيق التنمية المستدامة.',
                'جمعية تعمل على تمكين المرأة والطفل في المجتمع.',
                'منظمة تنموية تسعى إلى تحسين جودة الحياة في المناطق الفقيرة.',
                'مبادرة أهلية تهدف إلى دعم التعليم وتوفير فرص التدريب.',
                'منظمة تركز على القضايا البيئية والتوعية المجتمعية.',
                'نقدم الدعم النفسي والاجتماعي للفئات الأكثر احتياجاً.',
                'مؤسسة تطوعية تنفذ مشاريع إنسانية متنوعة في ليبيا.'
            ]),
            'city_id' => City::factory(),
            'sector_id' => Sector::factory(),
            'user_id' => User::factory(),
        ];
    }
}
