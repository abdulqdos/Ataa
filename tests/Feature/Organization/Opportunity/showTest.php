<?php

use App\Models\Opportunity;
use App\Models\Request;
use App\Models\User;
use App\Models\Volunteer;
use function Pest\Laravel\actingAs;

beforeEach(function () {
    $this->organization = User::factory()->create(
        [
            'role' => 'organization',
        ]
    );

    $this->opportunity = Opportunity::factory()->create();
    $this->requests = Request::factory(10)->recycle($this->opportunity)->create();
});

it('must be an organization', function ($badRole) {
    $user = User::factory()->create([
        'role' => $badRole,
    ]);

    actingAs($user)
    ->get(route('organization.opportunity.show' , $this->opportunity ))->assertRedirect('/');
})->with([
    'admin',
    'volunteer'
]);

it('return a correct component', function () {
    actingAs($this->organization)
        ->get(route('organization.opportunity.show' , $this->opportunity ))->assertSeeLivewire('organization.opportunity.show');
});

it('can show  opportunity', function () {
    actingAs($this->organization);
    Livewire::test('organization.opportunity.show' , ['opportunity' => $this->opportunity])
        ->assertSet('opportunity', $this->opportunity);
});


it('accepts a volunteer request and updates status correctly', function () {
    actingAs($this->organization);
    $this->withoutExceptionHandling();
    $volunteer = Volunteer::factory()->create();
    $request = Request::factory()
        ->for($volunteer)
        ->for($this->opportunity)
        ->create(['status' => 'pending']);

    Livewire::test('organization.opportunity.show', ['opportunity' => $this->opportunity])
        ->set('requestId', $request->id)
        ->call('updateRequestStatus', 'accepted')
        ->assertRedirect(route('organization.opportunity.show', $this->opportunity));

    // Refresh Request
    $updatedRequest = $request->fresh();

    // Change Request
    expect($updatedRequest->status)->toBe('accepted');
    expect($this->opportunity->fresh()->accepted_count)->toBe(1);

    // Assert Notification
    $this->assertDatabaseHas('notifications', [
        'user_id' => $volunteer->user->id,
        'title' => $this->opportunity->title,
        'message' =>  'مبروك لقد تم قبولك في فرصة تطوعية، نرجو حضورك في الموعد المحدد .'
    ]);

    // Assert Volunteer opportunity
    $this->assertDatabaseHas('volunteer_opportunities', [
        'volunteer_id' => $volunteer->id,
        'opportunity_id' => $this->opportunity->id,
    ]);

});

it('declines a volunteer request', function () {
    actingAs($this->organization);

    $volunteer = Volunteer::factory()->create();
    $request = Request::factory()
        ->for($volunteer)
        ->for($this->opportunity)
        ->create(['status' => 'pending']);

    Livewire::test('organization.opportunity.show', ['opportunity' => $this->opportunity])
        ->set('requestId', $request->id)
        ->call('updateRequestStatus', 'declined')
        ->assertRedirect(route('organization.opportunity.show', $this->opportunity));

    // Refresh the request from database
    $updatedRequest = $request->fresh();

    // Assert request status was updated
    expect($updatedRequest->status)->toBe('declined');

    // Assert opportunity accepted_count was NOT incremented
    expect($this->opportunity->fresh()->accepted_count)->toBe(0);

    // Assert no notification was created for declined status
    $this->assertDatabaseMissing('notifications', [
        'user_id' => $volunteer->user->id,
    ]);

});

