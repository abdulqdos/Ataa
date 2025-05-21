<?php

use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('must be an admin', function ($badRole) {
    $user = User::factory()->create([
        'role' => $badRole,
    ]);
    actingAs($user);
    get(route('admin.cities.create'))->assertRedirect(route('home'));
})->with(['volunteer' , 'organization']);
it('return a correct component' , function () {
    Livewire::test('admin.cities.create')
        ->assertSeeLivewire('admin.cities.create');
});
it('can store a city' , function () {
    Livewire::test('admin.cities.create')
        ->set('name' , 'مصراته')
        ->call('store');

    $this->assertDatabaseCount('cities', 1);
});
it('redirect to correct component', function () {
   Livewire::test('admin.cities.create')
    ->set('name' , 'مصراتة')
    ->call('store')
   ->assertRedirect(route('admin.cities'));
});
it('Invalid Name' , function ($badName) {
    Livewire::test('admin.cities.create')
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
