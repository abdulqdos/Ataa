<?php

use App\Models\User;
use App\Models\Volunteer;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

beforeEach(function () {
    $this->user = User::factory()->create([
        'role' => 'volunteer',
    ]);

    $this->volunteer = Volunteer::factory()->recycle($this->user)->create();
});

it('must be an organization', function ($badRole) {
    $user = User::factory()->create([
        'role' => $badRole,
    ]);

    $volunteer = Volunteer::factory()->recycle($user)->create();
    actingAs($user);
    get(route('organization.volunteers.show' , $volunteer->id))
    ->assertRedirect('/');
})->with([
    'admin',
    'volunteer',
]);

it('redirect a correct component' , function () {
    Livewire::test('organization.volunteers.show')
        ->assertSeeLivewire('organization.volunteers.show');
});


it('redirect a correct Volunteer' , function () {
    Livewire::test('organization.volunteers.show' , ['volunteer' => $this->volunteer])
        ->assertSet('volunteer' , $this->volunteer);
});
