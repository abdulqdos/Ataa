<?php

use App\Livewire\Volunteer\MyOpportunity;
use App\Models\Opportunity;
use App\Models\User;
use App\Models\Volunteer;
use function Pest\Laravel\actingAs;

it('must be volunteer' , function ($badRole) {
    $user = User::factory()->create([
        'role' => $badRole,
    ]);

    actingAs($user)
        ->get(route('volunteer.myOpportunity'))->assertRedirect('/');
})->with([
    'admin',
    'organization'
]);

it('return a correct component' , function () {
    $user = User::factory()->create([
        'role' => 'volunteer',
    ]);

    Volunteer::factory()->recycle($user)->create();

    actingAs($user);

    Livewire::test('volunteer.my-opportunity')
        ->assertSeeLivewire('volunteer.my-opportunity');
});
