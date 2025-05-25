<?php

use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('must be a manager' , function ($badRole) {
    $user = User::factory()->create([
        'role' => $badRole
    ]);
    actingAs($user);
    get(route('admin.admins.create'))->assertRedirect(route('home'));
})->with([
    'volunteer',
    'organization',
    'admin'
]);

beforeEach(function () {
    $user = User::factory()->create([
        'role' => 'manager'
    ]);
    actingAs($user);
});
it('return a correct component' , function () {
    Livewire::test('admin.admins.create')
        ->assertSeeLivewire('admin.admins.create');
});
it('can store an admin' , function () {
    Livewire::test('admin.admins.create')
        ->set('user_name' , 'abd_alqdos')
        ->set( 'email' , 'admin@gmail.com')
        ->call('store');

    $this->assertDatabaseCount('users' , 2);
});
it('Redirect to correct page' , function () {
    Livewire::test('admin.admins.create')
        ->set('user_name' , 'abd_alqdos')
        ->set( 'email' , 'admin@gmail.com')
        ->call('store')
        ->assertRedirect(route('admin.admins'));
});
it('Invalid user name' , function ($badUserName) {
    Livewire::test('admin.admins.create')
        ->set('user_name' , $badUserName)
        ->set( 'email' , 'admin@gmail.com')
        ->call('store')
        ->assertHasErrors('user_name');
})->with([
    'as',
    '<script></script>',
    12,
    1.5,
    null
]);
it('Invalid email' , function ($badEmail) {
    Livewire::test('admin.admins.create')
        ->set('user_name' ,'abd_alqdos')
        ->set( 'email' , $badEmail)
        ->call('store')
        ->assertHasErrors('email');
})->with([
    '@ewe@.com',
    'abdu'
]);
