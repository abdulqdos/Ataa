<?php

use App\Models\City;
use App\Models\Sector;
use App\Models\User;
use function Pest\Laravel\actingAs;

beforeEach(function () {
   $this->city = City::factory()->create();
   $this->sector = Sector::factory()->create();
});

it('must be a guest' , function () {
    $user = User::factory()->create();

    actingAs($user)
        ->get(route('signup'))->assertRedirect('/');
});

it('return a correct' , function () {
        Livewire::test('authentication.signup')
            ->assertViewIs('livewire.authentication.signup');
});

it('creates a volunteer account' , function () {
    Livewire::test('authentication.signup')
        ->set('user_name' , 'ragabAbusen')
        ->set('email' , 'ragab_abusen@gmail.com')
        ->set('password' , 'password' )
        ->set('password_confirmation' , 'password')
        ->set('userType' , 'volunteer')
        ->set('first_name' , 'abdulqdos')
        ->set('last_name' , 'alabinie')
        ->set('gender' , 'male')
        ->set('age' , 22)
        ->set('phone_number' , 1916050468)
        ->call('register');

    $this->assertDatabaseCount('users', 1);
    $this->assertDatabaseCount('volunteers', 1);
});

it('creates a organization account' , function () {
    Livewire::test('authentication.signup')
        ->set('user_name' , 'ragabAbusen')
        ->set('email' , 'ragab_abusen@gmail.com')
        ->set('password' , 'password' )
        ->set('password_confirmation' , 'password')
        ->set('userType' , 'organization')
        ->set('name' , 'abdulqdos')
        ->set('contact_email' , 'alabinie@com')
        ->set('city' , $this->city->id)
        ->set('sector' , $this->sector->id)
        ->set('phone_number_organization' , 1916050468)
        ->call('register');

    $this->assertDatabaseCount('users', 1);
    $this->assertDatabaseCount('organizations', 1);
});

it('redirect to correct component if he volunteer' , function () {
    Livewire::test('authentication.signup')
        ->set('user_name' , 'ragabAbusen')
        ->set('email' , 'ragab_abusen@gmail.com')
        ->set('password' , 'password' )
        ->set('password_confirmation' , 'password')
        ->set('userType' , 'volunteer')
        ->set('first_name' , 'abdulqdos')
        ->set('last_name' , 'alabinie')
        ->set('gender' , 'male')
        ->set('age' , 22)
        ->set('phone_number' , 1916050468)
        ->call('register')
        ->assertRedirect('/');
});

it('redirect to correct component if he organization' , function () {
    Livewire::test('authentication.signup')
        ->set('user_name' , 'ragabAbusen')
        ->set('email' , 'ragab_abusen@gmail.com')
        ->set('password' , 'password' )
        ->set('password_confirmation' , 'password')
        ->set('userType' , 'organization')
        ->set('name' , 'abdulqdos')
        ->set('contact_email' , 'alabinie@com')
        ->set('city' , $this->city->id)
        ->set('sector' , $this->sector->id)
        ->set('phone_number_organization' , 1916050468)
        ->call('register')
        ->assertRedirect(route('organization.dashboard'));
});

it('Invalid User name', function ($badUserName) {
    Livewire::test('authentication.signup')
        ->set('user_name', $badUserName)
        ->call('register')
        ->assertHasErrors(['user_name']);
})->with([
    '',
    'as',
    str_repeat('a' , 21),
    null,
    1,
    1.5,
    '<script>'
]);


it('Invalid Email', function ($badEmail) {
    Livewire::test('authentication.signup')
        ->set('email', $badEmail)
        ->call('register')
        ->assertHasErrors(['email']);
})->with([
    '', 'invalid-email', 'user@', 'user@domain,com', null
]);

it('Invalid Password', function ($badPassword) {
    Livewire::test('authentication.signup')
        ->set('password', $badPassword)
        ->set('password_confirmation', $badPassword)
        ->call('register')
        ->assertHasErrors(['password']);
})->with([
    '', '123', 'short', str_repeat('a', 5), null
]);

it('Password Confirmation Mismatch', function ($passwords) {
    Livewire::test('authentication.signup')
        ->set('password', $passwords[0])
        ->set('password_confirmation', $passwords[1])
        ->call('register')
        ->assertHasErrors(['password']);
})->with([
    ['password123', 'password321'],
    ['securePass', 'SecurePass'],
    ['pass', 'pass123']
]);

it('Invalid First Name', function ($badFirstName) {
    Livewire::test('authentication.signup')
        ->set('first_name', $badFirstName)
        ->call('register')
        ->assertHasErrors(['first_name']);
})->with([
    '', null, 'A', str_repeat('a', 51), '1234'
]);

it('Invalid Last Name', function ($badLastName) {
    Livewire::test('authentication.signup')
        ->set('last_name', $badLastName)
        ->call('register')
        ->assertHasErrors(['last_name']);
})->with([
    '', null, 'B', str_repeat('b', 51), '5678'
]);

it('Invalid Age', function ($badAge) {
    Livewire::test('authentication.signup')
        ->set('age', $badAge)
        ->call('register')
        ->assertHasErrors(['age']);
})->with([
    'invalid', -1, 150, null
]);

it('Invalid Phone Number', function ($badPhone) {
    Livewire::test('authentication.signup')
        ->set('phone_number', $badPhone)
        ->call('register')
        ->assertHasErrors(['phone_number']);
})->with([
    '', 'invalid-phone', '12345', '000000000000', null
]);

it('Invalid Contact Email for Organization', function ($badContactEmail) {
    Livewire::test('authentication.signup')
        ->set('contact_email', $badContactEmail)
        ->set('userType' , 'organization')
        ->call('register')
        ->assertHasErrors(['contact_email']);
})->with([
    '', 'invalid-email', 'contact@', 'contact@domain,com', null
]);

it('Invalid City Selection', function ($badCity) {
    Livewire::test('authentication.signup')
        ->set('city', $badCity)
        ->set('userType' , 'organization')
        ->call('register')
        ->assertHasErrors(['city']);
})->with([
    null, ''
]);

it('Invalid Sector Selection', function ($badSector) {
    Livewire::test('authentication.signup')
        ->set('sector', $badSector)
        ->set('userType' , 'organization')
        ->call('register')
        ->assertHasErrors(['sector']);
})->with([
    null, ''
]);

