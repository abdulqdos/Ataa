<?php

namespace Database\Factories;

use App\Models\Organization;
use App\Models\Sector;
use Carbon\Carbon;
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
        $startDate = Carbon::now()->addDays(rand(0, 1));
        $endDate = $startDate->copy()->addDays(rand(1, 20));

        $startTime = $this->faker->time('H:i:s');
        $startTimeCarbon = Carbon::createFromFormat('H:i:s', $startTime);
        $endTimeCarbon = (clone $startTimeCarbon)->addHours(rand(1, 4));
        return [
            'title' => $this->faker->randomElement([
                'حملة تنظيف شاطئ',
                'توزيع سلال غذائية',
                'ورشة توعوية عن البيئة',
                'حملة تبرع بالدم',
                'فعالية للأطفال الأيتام',
                'صيانة مرافق عامة',
                'مساعدة كبار السن',
                'دعم ذوي الاحتياجات الخاصة',
                'تنظيم معرض خيري',
                'حملة تشجير في الأحياء'
            ]),

            'description' => $this->faker->randomElement([
                'فرصة للمشاركة في تنظيف الشواطئ المحلية ورفع الوعي البيئي.',
                'نقوم بتوزيع سلال غذائية على الأسر المحتاجة بمساعدة المتطوعين.',
                'ورشة تهدف إلى توعية المجتمع بأهمية حماية البيئة والمحافظة عليها.',
                'حملة تهدف إلى جمع تبرعات دم لإنقاذ أرواح المرضى والمحتاجين.',
                'تنظيم يوم ترفيهي وثقافي للأطفال في دار الأيتام.',
                'مبادرة لصيانة وإصلاح المرافق العامة في المدينة.',
                'تقديم المساعدة والرعاية اليومية لكبار السن في منازلهم.',
                'فعالية ترفيهية وتعليمية موجهة لذوي الاحتياجات الخاصة.',
                'نقوم بتنظيم معرض خيري لبيع منتجات حرفية لصالح المحتاجين.',
                'المشاركة في زراعة الأشجار وتحسين المساحات الخضراء في الأحياء السكنية.'
            ]),

            'start_date' => $startDate,
            'end_date' => $endDate,

            'location' => $this->faker->randomElement([
                'طرابلس - حي الأندلس',
                'بنغازي - شارع دبي',
                'مصراتة - وسط المدينة',
                'سبها - القرضة',
                'الزاوية - السوق الشعبي',
                'زليتن - الساحة العامة',
                'درنة - حي الساحل',
                'البيضاء - شارع الجمهورية',
                'الخمس - الكورنيش',
                'غريان - المدينة القديمة'
            ]),

            'location_url' => "https://www.google.com/maps/search/?api=1&query=" .
                $this->faker->latitude . "," . $this->faker->longitude,

            'has_certificate' => $this->faker->boolean(60),
            'count' => $this->faker->numberBetween(30, 50),
            'organization_id' => Organization::factory(),
            'sector_id' => Sector::factory(),
            'start_time' => $startTimeCarbon,
            'end_time' => $endTimeCarbon,
        ];
    }
}
