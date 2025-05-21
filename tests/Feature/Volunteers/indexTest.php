<?php

use App\Models\User;
use App\Models\Volunteer;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

beforeEach(function () {
    $this->users = User::factory(10)->create(
        [
            'role' => 'volunteer',
        ]
    );

    $this->volunteers = Volunteer::factory(10)->recycle($this->users)->create();
});
it('must be guest or volunteer' , function ($badRole) {
    $user = User::factory()->create([
        'role' => $badRole,
    ]);

    actingAs($user);
    get(route('volunteers'))
        ->assertRedirect('/');
})->with([
    'admin',
]);

it('return a correct component' , function () {
    Livewire::test('volunteers.index')
        ->assertSeeLivewire('volunteers');
});

it('return a correct Data' , function () {
    Livewire::test('volunteers.index')
        ->assertSee( $this->volunteers->first()->first_name);
});
