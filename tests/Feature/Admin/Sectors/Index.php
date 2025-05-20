<?php


use App\Models\Sector;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

beforeEach(function () {
    $this->user = User::factory()->create(
        [
            'role' => 'admin',
        ]
    );
});

it('must be an admin' , function ($badRole) {
    $user = User::factory()->create([
        'role' => $badRole,
    ]);

    actingAs($user)->get(route('admin.sectors'))->assertRedirect('/');
})->with([
    'volunteer',
    'organization',
]);

it('must be return a correct' , function () {
    Livewire::test('admin.sectors.index')
        ->assertSeeLivewire('admin.sectors');
});

it('set a correct data' , function () {
    actingAs($this->user);

    $sectors = Sector::factory(10)->create();
    Livewire\Livewire::test('admin.sectors.index')
        ->assertSee($sectors->first()->name);
});
