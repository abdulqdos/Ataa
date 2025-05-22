<?php

use App\Models\City;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

beforeEach(function () {
    $this->city = City::factory()->create();
});

it('must be an admin' , function ($badRole) {

    $user = User::factory()->create([
        'role' => $badRole,
    ]);

    actingAs($user)->get(route('admin.cities.show' , $this->city->id))->assertRedirect(route('home'));
})->with(['volunteer' , 'organization']);
it('return a correct component' , function () {
    Livewire::test('admin.cities.show' , ['city' => $this->city->id])->assertSeeLivewire('admin.cities.show');
});
it('set a correct city' ,  function () {
    Livewire::test('admin.cities.show' , ['city' => $this->city])
        ->assertSet('city', $this->city);
});
it('set a correct Organizations' , function () {
    Livewire::test('admin.cities.show' , ['city' => $this->city])
        ->assertViewHas('organizations', function ($value) {
            return $value instanceof LengthAwarePaginator;
        });;
});

