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
        // Accounts
        $user = User::factory()->create([
            'user_name' => 'Test User',
            'email' => 'volunteer@example.com',
            'role' => 'volunteer',
        ]);
        $organization = User::factory()->create([
            'user_name' => 'Test User',
            'email' => 'organization@example.com',
            'role' => 'organization',
        ]);
        User::factory()->create([
            'user_name' => 'Test User',
            'email' => 'test@example.com',
            'role' => 'admin',
        ]);
        $volunteer = Volunteer::factory()->recycle($user)->create();

        // Opportunities
        $opportunity = Opportunity::factory(30)->recycle(Organization::factory()->recycle($organization)->create())->create();

        // Organizations
        $orgs = User::factory(20)->create([
            'role' => 'organization',
        ]);
        $organizations = Organization::factory(20)->recycle($orgs)->create();

        // Opportunity For Selected Organization
        Opportunity::factory(100)->recycle($organizations)->create();

        // Opportunity For Selected volunteer
        $opportunitiesVolunteer = Opportunity::factory(10)->create();
        $volunteer->opportunities()->attach($opportunitiesVolunteer->pluck('id'));

        // Volunteers for selected Opportunity
        $opVolunteer = Volunteer::factory(10)->create();
        $op  = Opportunity::find(1);
        $op->update([
            'start_date' => Carbon::createFromDate(Carbon::now()->year, 4, 1)->subMonth(),
            'end_date' => Carbon::createFromDate(Carbon::now()->year, 4, 15)->subMonth(),
            'accepted_count' => 10,
        ]);
        $op->volunteers()->attach($opVolunteer->pluck('id'));
        // Requests
        Request::factory(10)->recycle($opportunity)->recycle($organization)->create();

        // Notifications
        Notification::factory(5)->recycle($volunteer)->create();

        // Cities
        City::factory(10)->create();

        // Sectors
        Sector::factory(10)->create();
    }
}
