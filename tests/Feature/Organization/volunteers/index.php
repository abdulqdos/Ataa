<?php

use App\Models\Opportunity;
use App\Models\Organization;
use App\Models\User;
use App\Models\Volunteer;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

beforeEach(function () {
    $this->organization = User::factory()->create(
        [
            'role' => 'organization',
        ]
    );

    $this->org = Organization::factory()->recycle($this->organization)->create();

    $this->opportunity = Opportunity::factory()->recycle($this->org)->create();

    $this->volunteers_user = User::factory()->create([
        'role' => 'volunteer',
    ]);

    $this->volunteers = Volunteer::factory(10)->recycle($this->volunteers_user)->create();

    foreach ($this->volunteers as $volunteer) {
        $this->opportunity->volunteers()->attach($volunteer->id);
    }

});

it('must be a organization' , function($badRole){
    $user = User::factory()->create(
        [
            'role' => $badRole,
        ]
    );
    actingAs($user);
    get(route('organization.volunteers' , [ 'opportunity' => $this->opportunity]))->assertRedirect('/');
})->with([ 'admin' , 'volunteer' ]);

it('return a correct component' , function () {
    Livewire::test('organization.volunteers')
        ->assertSeeLivewire('organization.volunteers');
});

it('return a correct Data' , function () {
    Livewire::test('organization.volunteers' , ['opportunity' => $this->opportunity])
        ->assertSee($this->volunteers->first()->first_name);
});
