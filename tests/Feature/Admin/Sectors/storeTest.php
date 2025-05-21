<?php

use App\Models\User;
use function Pest\Laravel\actingAs;

it('must be an admin' , function ($badRole) {
    $user = User::factory()->create([
        'role' => $badRole,
    ]);

    actingAs($user)
        ->get(route('admin.sectors.create'))->assertRedirect(route('home'));
})->with([
    'volunteer',
    'organization',
]);

it('set a correct component' , function () {
    Livewire::test('admin.sectors.create')
        ->assertSeeLivewire('admin.sectors.create');
});

it('create a sector', function () {
    Livewire::test('admin.sectors.create')
        ->set('name' , 'الصحة')
        ->call('store');

    $this->assertDatabaseCount('sectors', 1);
});

it('redirect to correct page', function () {
    Livewire::test('admin.sectors.create')
        ->set('name' , 'الصحة')
        ->call('store')
        ->assertRedirect(route('admin.sectors'));
});

it('Invalid a correct data', function ($badName) {
    Livewire::test('admin.sectors.create')
        ->set('name' , $badName)
        ->call('store')
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


