<?php

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use function Pest\Laravel\actingAs;

beforeEach(function () {
    User::factory(20)->create([
        'role' => 'admin',
    ]);
});
it('must be an admin', function ($badRole) {
    $user = User::factory()->create([
        'role' => $badRole,
    ]);

    actingAs($user)
        ->get(route('admin.admins'))->assertRedirect(route('home'));
})->with([
    'volunteer',
    'organization',
    'admin',
]);
beforeEach(function () {
    $user = User::factory()->create([
        'role' => 'manager'
    ]);

    actingAs($user);
});
it('correct component' , function () {
    Livewire::test('admin.admins.index')
        ->assertSeeLivewire('admin.admins');
});
it('send a correct data' , function () {
    Livewire::test('admin.admins.index')
        ->assertViewHas('admins' , function ($value) {
            return $value instanceof LengthAwarePaginator ;
        });
});
