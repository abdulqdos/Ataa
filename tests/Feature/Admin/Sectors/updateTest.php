<?php

use App\Models\Sector;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

beforeEach(function () {
    $this->sector = Sector::factory()->create();
});


it('must be an admin' , function ($badRole) {
    $user = User::factory()->create([
        'role' => $badRole,
    ]);

    actingAs($user);
    get(route('admin.sectors.edit', $this->sector->id))->assertRedirect(route('home'));
})->with([
    'volunteer',
    'organization'
]);

it('return a correct component' , function () {
    Livewire::test('admin.sectors.edit', [ 'sector' => $this->sector->id ])
        ->assertSeeLivewire('admin.sectors.edit');
});

it('can update a sector', function () {
    Livewire::test('admin.sectors.edit', [ 'sector' => $this->sector->id ])
        ->set('name','الخارجية')
        ->call('update');

    $this->assertDatabaseHas('sectors', [
        'name' => 'الخارجية'
    ]);
});

it('Redirect to correct page' , function () {
    Livewire::test('admin.sectors.edit', [ 'sector' => $this->sector->id ])
        ->set('name','الخارجية')
        ->call('update')
        ->assertRedirect(route('admin.sectors'));
});

it('Invalid a correct data', function ($badName) {
    Livewire::test('admin.sectors.edit', [ 'sector' => $this->sector->id ])
        ->set('name' , $badName)
        ->call('update')
        ->assertHasErrors('name');
})->with([
    '',
    1,
    1.5,
    null,
    true,
    str()->repeat('a' , 51),
    '<script></script>'
]);

