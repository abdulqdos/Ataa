<?php

use App\Livewire\Authentication\Login;
use App\Models\User;
use function Pest\Laravel\actingAs;

beforeEach(function () {
    $this->user = User::factory()->create();
});
it('must be a guest' , function () {
    actingAs($this->user)
        ->get(route('login'))->assertRedirect('/');
});

it('return the correct component' , function () {
    Livewire::test('authentication.login')
        ->assertViewIs('livewire.authentication.login');
});



it('assert redirect to admin page' , function () {
    $user = User::factory()->create([
        'email' => 'email@example.com',
        'password' => bcrypt('password'),
        'role' => 'admin',
    ]);

    Livewire::test(Login::class)
        ->set('email', $user->email)
        ->set('password', 'password')
        ->call('authenticate')
        ->assertRedirect('/admin/dashboard');
});


it('assert redirect to volunteer page' , function () {
    $user = User::factory()->create([
        'email' => 'email@example.com',
        'password' => bcrypt('password'),
        'role' => 'volunteer',
    ]);

    Livewire::test(Login::class)
        ->set('email', $user->email)
        ->set('password', 'password')
        ->call('authenticate')
        ->assertRedirect('/');
});

it('assert redirect to organization page' , function () {
    $user = User::factory()->create([
        'email' => 'email@example.com',
        'password' => bcrypt('password'),
        'role' => 'organization',
    ]);

    Livewire::test(Login::class)
        ->set('email', $user->email)
        ->set('password', 'password')
        ->call('authenticate')
        ->assertRedirect('/organization/dashboard');
});

it('email is valid' , function ($badEmail) {
    Livewire::test(Login::class)
        ->set('email', $badEmail)
        ->set('password', 'password')
        ->call('authenticate')
        ->assertHasErrors(['email']);

})->with([
   "test@.com",
    "test@com@domain.com",
]);

it('password is valid' , function ($badPassword) {
    Livewire::test(Login::class)
        ->set('email', 'email@gmail.com')
        ->set('password', $badPassword)
        ->call('authenticate')
        ->assertHasErrors(['password']);
})->with([
    str_repeat('a' , '7'),
    str_repeat('a' , '21'),
    1,
    1.5,
    null
]);
