<?php


use App\Models\City;
use App\Models\User;
use function Pest\Laravel\actingAs;

beforeEach(function () {
   $this->city = City::factory()->create();
});
it('must be an admin' , function ($badRole) {
    $user = User::factory()->create([
        'role' => $badRole,
    ]);
    actingAs($user)
        ->get(route('admin.cities.edit', $this->city->id))->assertRedirect(route('home'));
})->with(['volunteer','organization']);

it('return a correct component' , function () {
    Livewire::test('admin.cities.edit' , ['city' => $this->city])
        ->assertSeeLivewire('admin.cities.edit');
});

it('can update a city' , function () {
    Livewire::test('admin.cities.edit' , ['city' => $this->city])
        ->set('name', 'بنغازي')
        ->call('update');

    $this->assertDatabaseHas('cities', [
        'name' => 'بنغازي'
    ]);
});

it('redirect to correct component', function () {
    Livewire::test('admin.cities.edit' , ['city' => $this->city])
        ->set('name' , 'مصراتة')
        ->call('update')
        ->assertRedirect(route('admin.cities'));
});
it('Invalid Name' , function ($badName) {
    Livewire::test('admin.cities.edit' , ['city' => $this->city])
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
