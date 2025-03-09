<?php

use App\Models\User;
use function Pest\Laravel\actingAs;

it('must be a guest' , function () {
    $user = User::factory()->create();

    actingAs($user)
        ->get(route('signup'))->assertRedirect('/');
});

it('redirect to correct' , function () {
        Livewire::test('authentication.signup')
            ->assertViewIs('livewire.authentication.signup');
});

it('creates a new user' , function () {

});
it('Return a correct Component');
it('Invalid User name');
