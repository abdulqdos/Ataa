<?php


use App\Models\Organization;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

beforeEach(function () {

    $this->user = User::factory()->create([
        'role' => 'organization',
    ]);

    Organization::factory()->recycle($this->user)->create();
});
it('must be an organization' , function ($badRole) {

    $user = User::factory()->create([
        'role' => $badRole ,
    ]);
    actingAs($user);
    get(route('organization.update-profile'))->assertRedirect('/');
})->with([
    'admin',
    'volunteer'
]);

it('return a correct component' , function () {
    actingAs($this->user);
    Livewire::test('organization.profile.update' , ['user' => $this->user])
        ->assertSeeLivewire('organization.profile.update');
});
