<?php


use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

beforeEach(function () {

    $this->user = User::factory()->create([
        'role' => 'organization',
    ]);
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
    \Livewire\Livewire::test('organization.profile.update')
        ->assertSeeLivewire('organization.profile.update');
});
