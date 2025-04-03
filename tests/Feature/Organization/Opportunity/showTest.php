<?php

use App\Models\Opportunity;
use App\Models\Request;
use App\Models\User;
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



