<?php

use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;


it('must be a organization' , function ($badRole) {
    $user = User::factory()->create([
        'role' => $badRole,
    ]);

    actingAs($user);

    get(route('organization.volunteers'))->assertRedirect('/');
})->with([
    'volunteer',
    'admin',
]);

it('return a correct component', function () {
    Livewire::test('organization.volunteers.index')
        ->assertSeeLivewire('organization.volunteers');
});
