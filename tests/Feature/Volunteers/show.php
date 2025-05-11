<?php

use App\Models\User;
use App\Models\Volunteer;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('must be a volunteer or guest', function ($badRole) {
    $badRole = User::factory()->create(['role' => $badRole]);
    $volunteer = Volunteer::factory()->create();
    actingAs($badRole);
        get(route('volunteers.profile', $volunteer->id))->assertRedirect('/');
})->with([
    'admin',
]);

it('must be return a correct component' , function () {
    Livewire::test('volunteers.profile')
        ->assertSeeLivewire('volunteers.profile');
});
