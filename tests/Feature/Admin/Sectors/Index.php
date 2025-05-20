<?php


use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

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
