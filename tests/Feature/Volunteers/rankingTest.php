<?php

use App\Models\User;
use App\Models\Volunteer;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('must be a volunteer or guest', function ($badRole) {
    $badRole = User::factory()->create(['role' => $badRole]);
    actingAs($badRole);
    get(route('volunteers.ranking'))->assertRedirect('/');
})->with([
    'admin',
]);


it('return a correct component', function () {
    Volunteer::factory(30)->create();
    Livewire::test('volunteers.ranking')
        ->assertSeeLivewire('volunteers.ranking');
});

it('send a Data' , function () {
   Volunteer::factory(30)->create();
   $volunteers = Volunteer::orderByDesc('eval_avg');
    Livewire::test('volunteers.ranking')
        ->assertSee($volunteers->first()->first_name);
});

