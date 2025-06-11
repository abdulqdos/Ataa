<?php

use App\Models\Organization;
use App\Models\User;
use function Pest\Laravel\actingAs;

beforeEach(function () {
    $this->org = User::factory()->create();
    $this->organization = Organization::factory()->recycle($this->org)->create();
});

it('must be guest or volunteer', function ($badRole) {
    $user = User::factory()->create([
        'role' => $badRole
    ]);

    if($badRole === 'organization') {
        actingAs($user)
            ->get(route('organizations.show', $this->organization))->assertRedirect(route('organization.dashboard'));
    } else {
        actingAs($user)
            ->get(route('organizations.show', $this->organization))->assertRedirect(route('home'));
    }
})->with([
    'organization',
    'admin'
]);
it('assert a correct livewire' , function () {
    Livewire::test('organizations.show')
        ->assertSeeLivewire('organizations.show');
});
it('assert set a correct data' , function () {
    Livewire::test('organizations.show' , ['organization' => $this->organization])
        ->assertSee($this->organization->name);
});
