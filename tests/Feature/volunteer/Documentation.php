<?php

use App\Livewire\Volunteer\Profile\Documentation;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('must be a volunteer' , function ($badRole) {
    $user = User::factory()->create([
        'role' => $badRole,
    ]);

    actingAs($user);
    get(route('volunteers.myOpportunity.documentation' , 1))->assertRedirect('/');
})->with([
    'admin'
]);

it('return a correct component' , function () {
    Livewire::test('volunteer.Profile.Documentation')
        ->assertSeeLivewire('volunteer.profile.documentation');
});


