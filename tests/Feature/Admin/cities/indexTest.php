<?php


use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use function Pest\Laravel\actingAs;

it('must be an admin' ,  function ($badRole) {
    $user = User::factory()->create(
        [
            'role' => $badRole,
        ]
    );

    actingAs($user)
        ->get(route('admin.cities'))->assertRedirect(route('home'));
})->with([ 'volunteer' , 'organization']);
it('return a correct component', function () {
    Livewire::test('admin.cities.index')
        ->assertSeeLivewire('admin.cities');
});

it('assert a correct opportunities' ,  function () {
    Livewire::test('admin.cities.index')
        ->assertViewHas('cities', function ($value) {
            return $value instanceof LengthAwarePaginator;
        });
});

