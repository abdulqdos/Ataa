<?php

use App\Models\User;
use App\Models\Volunteer;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

beforeEach(function () {

    $this->user =  User::factory()->create([
        'role' => 'volunteer',
    ]);

   $this->volunteer = Volunteer::factory()->recycle($this->user)->create();
});

it('must be an volunteer' , function ($badRole) {
    $user = User::factory()->create([
        'role' => $badRole,
    ]);

    actingAs($user)->get(route('volunteer.profile'))->assertRedirect('/');
})->with([
    'admin',
    'organization'
]);

it('return a correct component' , function () {
    $user =  User::factory()->create([
        'role' => 'volunteer',
    ]);
    $this->volunteer = Volunteer::factory()->recycle($user)->create();

    actingAs($user);
    Livewire::test('volunteer.profile.update')
        ->assertSeeLivewire('volunteer.profile.update');
});

it('have a correct data' , function () {
    actingAs($this->user);
    Livewire::test('volunteer.profile.update')
        ->assertSet('user' , auth()->user());
});

it('can update profile' , function () {
    actingAs($this->user);

    Livewire::test('volunteer.profile.update')
        ->set('user_name', 'abdu_alqdus')
        ->set('email', 'abdu@gmail.com')
        ->set('first_name', 'عبدالقدوس')
        ->set('last_name', 'العبيني')
        ->set('phone_number', '916050468')
        ->set('gender', 'male')
        ->set('age', 22)
        ->set('bio', 'عمل تطوعي هوا جزء من حياتي اليومية')
        ->call('update');

    $this->assertDatabaseHas('users' , [
        'user_name' => 'abdu_alqdus',
        'email' => 'abdu@gmail.com',
    ]);

    $this->assertDatabaseHas('volunteers' , [
        'first_name' => 'عبدالقدوس',
        'last_name' => 'العبيني',
        'phone_number' => "916050468",
        'gender' => 'male',
        'age' => '22',
        'bio' => 'عمل تطوعي هوا جزء من حياتي اليومية',
    ]);
});

it('can change password' , function () {

    actingAs($this->user);

    Livewire::test('volunteer.profile.update')
        ->set('old_password', 'password')
        ->set('new_password', 'password2')
        ->set('new_password_confirmation', 'password2')
        ->call('changePassword');

    $this->assertTrue(
        Hash::check('password2', $this->user->fresh()->password)
    );
});
