<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Opportunity;
use App\Models\Organization;
use App\Models\Request;
use App\Models\Sector;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Volunteer;
use Database\Factories\OpportunityFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $volunteer = User::factory()->create([
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

        Volunteer::factory()->recycle($volunteer)->create();

        $opportunity = Opportunity::factory(30)->recycle(Organization::factory()->recycle($organization)->create())->create();

        $orgs = User::factory(20)->create([
            'role' => 'organization',
        ]);

        $organizations = Organization::factory(20)->recycle($orgs)->create();

        Opportunity::factory(100)->recycle($organizations)->create();

        Request::factory(10)->recycle($opportunity)->recycle($organization)->create();

        City::factory(10)->create();

        Sector::factory(10)->create();
    }
}
