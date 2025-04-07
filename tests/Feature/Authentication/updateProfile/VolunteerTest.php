<?php

use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

beforeEach(function () {
   $this->volunteer = User::factory()->create([
       'role' => 'volunteer',
   ]);
});

it('must be an volunteer' , function ($badRole) {
    $user = User::factory()->create([
        'role' => $badRole,
    ]);

    actingAs($user)->get(route('volunteer.profile'))->assertRedirect('/');
})->with([
    'admin',
    'organization'
]);

it('return a correct component' , function () {
    Livewire::test('authentication.update-profile.volunteer')
        ->assertSeeLivewire('authentication.update-profile.volunteer');
});

it('have a correct data' , function () {
    actingAs($this->volunteer);
    Livewire::test('authentication.update-profile.volunteer')
        ->assertSet('user' , auth()->user());
});
