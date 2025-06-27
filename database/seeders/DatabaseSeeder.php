<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Notification;
use App\Models\Opportunity;
use App\Models\Organization;
use App\Models\Request;
use App\Models\Sector;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Volunteer;
use Carbon\Carbon;
use Database\Factories\NotificationFactory;
use Database\Factories\OpportunityFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        activity()->disableLogging();

        // Sectors
        $sectors =  Sector::factory(5)->create()->unique();


        // Cities
        $cities = City::factory(5)->create()->unique();

        // Our Accounts
        $user = User::factory()->create([
            'user_name' => 'abdu_alqdos',
            'email' => 'volunteer@example.com',
            'role' => 'volunteer',
        ]);

        $organization = User::factory()->create([
            'user_name' => 'Red_Helal',
            'email' => 'organization@example.com',
            'role' => 'organization',
        ]);

        User::factory()->create([
            'user_name' => 'Admin',
            'email' => 'test@example.com',
            'role' => 'admin',
        ]);

        User::factory()->create([
            'user_name' => 'manager',
            'email' => 'manager@example.com',
            'role' => 'manager',
        ]);

        // Our Volunteer
        $volunteer = Volunteer::factory()->recycle($user)->create([
            'first_name' => 'عبدالقدوس',
            'last_name' => 'العبيني',
            'gender' => 'male',
            'phone_number' => "0916050468",
            'bio' => 'المبرمج الأقوى في تاريخ البشرية',
            'eval_avg' => '5',
            'age' => '22'
        ]);

        // Our Organization
        $org = Organization::factory()->recycle($organization)->recycle($sectors)->recycle($cities)->create([
            'name' => 'هلال الأحمر'
        ]);

        // Our Opportunities
        $upcomingOpportunities = Opportunity::factory(4)
            ->recycle($org)
            ->recycle($sectors)
            ->recycle($cities)
            ->create([
                'start_date' => Carbon::createFromDate(2025, 7, 21),
                'end_date' => Carbon::createFromDate(2025, 8, 8),
            ]);


        $activeOpportunities = Opportunity::factory(3)
            ->recycle($org)
            ->recycle($sectors)
            ->recycle($cities)
            ->sequence(
                ['start_date' => Carbon::yesterday(), 'end_date' => Carbon::createFromDate(2025, 7, 5)],
                ['start_date' => Carbon::createFromDate(2025, 6, 25), 'end_date' => Carbon::createFromDate(2025, 7, 10)],
                ['start_date' => Carbon::createFromDate(2025, 7, 1), 'end_date' => Carbon::createFromDate(2025, 7, 19)],
            )
            ->create();


        $completedOpportunities = Opportunity::factory(3)
            ->recycle($org)
            ->recycle($sectors)
            ->recycle($cities)
            ->sequence(
                ['start_date' => Carbon::createFromDate(2025, 6, 1), 'end_date' => Carbon::createFromDate(2025, 6, 24)],
                ['start_date' => Carbon::createFromDate(2025, 6, 10), 'end_date' => Carbon::createFromDate(2025, 6, 27)],
                ['start_date' => Carbon::createFromDate(2025, 6, 5), 'end_date' => Carbon::createFromDate(2025, 6, 30)],
            )
            ->create();

         // Organizations
        $orgs = User::factory(5)->create([
            'role' => 'organization',
        ]);

        $organizations = Organization::factory(5)->recycle($orgs)->recycle($sectors)->recycle($cities)->create();

       // Opportunity For Selected Organization
        Opportunity::factory(20)->recycle($organizations)->recycle($sectors)->recycle($cities)->create();

//        // Opportunity For Selected volunteer
        $op1 = $upcomingOpportunities->first();
        $op2 = $activeOpportunities->first();
        $op3 = $completedOpportunities->first();

        $volunteer->opportunities()->attach($op1->id);
        $volunteer->opportunities()->attach($op2->id);
        $volunteer->opportunities()->attach($op3->id);

        $op1->increment('accepted_count');
        $op2->increment('accepted_count');
        $op3->increment('accepted_count');

        // Volunteers For Our Opportunites

//        // Volunteers for selected Opportunity
        $opVolunteer = Volunteer::factory(10)->create();

        $op1->volunteers()->attach($opVolunteer);
        $op2->volunteers()->attach($opVolunteer);
        $op3->volunteers()->attach($opVolunteer);

        $op1->increment('accepted_count', 10);
        $op2->increment('accepted_count', 10);
        $op3->increment('accepted_count', 10);


        // Requests For Opportunities

        // Make Volunteers
        $users = User::factory(10)->create([
            'role' => 'volunteer',
        ]);

        // Request For Opportunities
        $volunteers = Volunteer::factory(10)->recycle($users)->create();
        Request::factory(10)->recycle(Opportunity::find(1))->recycle($volunteers)->create();

        // Our Volunteer Request
        Request::factory(1)->recycle(Opportunity::find(2))->recycle($volunteer)->create();

        // Notifications
        Notification::factory(5)->recycle($user)->create();


        activity()->enableLogging();
    }
}
