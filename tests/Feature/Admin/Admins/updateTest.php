<?php

use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

beforeEach(function () {
    $this->admin = User::factory()->create([
        'role' => 'admin'
    ]);
});
it('must be a manager' , function ($badRole) {
    $user = User::factory()->create([
        'role' => $badRole
    ]);
    actingAs($user);
    get(route('admin.admins.edit' , $this->admin))->assertRedirect(route('home'));
})->with([
    'volunteer',
    'admin',
    'organization'
]);
it('return a correct data' , function () {
    Livewire::test('admin.admins.edit')
        ->assertSet('admin' , $this->admin);
});
it('can update an admin' , function () {
    Livewire::test('admin.admins.edit' , ['admin' => $this->admin])
        ->set('user_name' , 'abdulqdos')
        ->set('email' , 'name@examle.com')
        ->call('update');

    $this->assertDatabaseHas('users' ,[
        'user_name' => 'abdulqdos',
        'email' => 'name@examle.com',
    ]);
});
it('redirect to correct page' , function () {
    Livewire::test('admin.admins.edit' , ['admin' => $this->admin])
        ->set('user_name' , 'abdulqdos')
        ->set('email' , 'name@examle.com')
        ->call('update')
        ->assertRedirect(route('admin.admins'));
});
