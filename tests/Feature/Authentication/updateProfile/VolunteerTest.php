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
    Livewire::test('authentication.update-profile.volunteer')
        ->assertSeeLivewire('authentication.update-profile.volunteer');
});

it('have a correct data' , function () {
    actingAs($this->user);
    Livewire::test('authentication.update-profile.volunteer')
        ->assertSet('user' , auth()->user());
});

it('can update profile' , function () {
    actingAs($this->user);

    $this->withoutExceptionHandling();
    Livewire::test('authentication.update-profile.volunteer')
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
