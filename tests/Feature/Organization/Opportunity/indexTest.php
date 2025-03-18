<?php

use App\Models\Opportunity;
use App\Models\User;
use function Pest\Laravel\actingAs;

beforeEach(function () {
    $this->organization = User::factory()->create([
            'role' => 'organization',
        ]);
});

it('must be an organization', function ($badRole) {
    $user = User::factory()->create([
        'role' => $badRole,
    ]);
    actingAs($user)
        ->get(route('organization.opportunity.create'))->assertRedirect(route('home'));
})->with([
        'admin', 'volunteer',]);

it('send a opportunity paginate to page', function () {

    Opportunity::factory(20)->recycle($this->organization)->create();

    actingAs($this->organization);


    Livewire::test('organization.opportunity.index')
    ->assertSee(Opportunity::where('organization_id', $this->organization->id)->first()->title)
    ->call('nextPage');

});
