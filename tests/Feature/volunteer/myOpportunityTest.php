<?php

use App\Livewire\Volunteer\MyOpportunity;
use App\Models\Opportunity;
use App\Models\User;
use App\Models\Volunteer;
use function Pest\Laravel\actingAs;

beforeEach(function () {
    $this->user = User::factory()->create([
        'role' => 'volunteer',
    ]);

    Volunteer::factory()->recycle($this->user)->create();
    Opportunity::factory()->create();
});

it('must be volunteer' , function ($badRole) {
    $user = User::factory()->create([
        'role' => $badRole,
    ]);

    actingAs($user)
        ->get(route('volunteers.myOpportunity' , 1))->assertRedirect('/');
})->with([
    'admin',
    'organization'
]);

it('return a correct component' , function () {
    actingAs($this->user);
    Livewire::test('volunteer.my-opportunity')
        ->assertSeeLivewire('volunteer.my-opportunity');
});

it('can cancel Registration', function () {
    $user = User::factory()->create([
        'role' => 'volunteer',
    ]);

    $volunteer = Volunteer::factory()->recycle($user)->create();

    $opportunity = Opportunity::factory()->create();

    $volunteer->opportunities()->attach($opportunity);

    $opportunity->update([
        'accepted_count' => 1,
    ]);

    actingAs($user);

    Livewire::test('volunteer.my-opportunity')
        ->set('selectedOpportunity', $opportunity)
        ->call('cancelRegistration');

    // Cancel
    $this->assertDatabaseMissing('volunteer_opportunities', [
        'volunteer_id' => $volunteer->id,
        'opportunity_id' => $opportunity->id,
    ]);

    // Send Notification
    $this->assertDatabaseHas('notifications', [
        'user_id' => $opportunity->organization_id,
    ]);

    $this->assertDatabaseHas('opportunities', [
        'accepted_count' => $opportunity->accepted_count - 1,
    ]);
});
