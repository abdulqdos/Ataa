<?php

use App\Models\User;
use function Pest\Laravel\actingAs;

it('must be an organization', function ($badRole) {
    $user = User::factory()->create([
        'role' => $badRole,
    ]);
    actingAs($user)
    ->get(route('organization.opportunity.create'))->assertRedirect(route('home'));
})->with([
    'volunteer',
    'admin'
]);

it('return a correct component' , function () {
    $user = User::factory()->create([
        'role' => 'organization',
    ]);

    actingAs($user)
        ->get(route('organization.opportunity.create'))->assertSeeLivewire('organization.opportunity.create');
});
