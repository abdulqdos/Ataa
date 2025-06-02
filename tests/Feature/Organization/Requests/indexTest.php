<?php

use App\Models\Opportunity;
use App\Models\Organization;
use App\Models\User;
use App\Models\Request;
use function Pest\Laravel\actingAs;

beforeEach(function () {
    $this->user = User::factory()->create([
        'role' => 'organization',
    ]);

    $this->organization = Organization::factory()->recycle($this->user)->create();
    $this->request = Request::factory()->create();
});

it('must be an organization ', function ($badRole) {
    $user = User::factory()->create([
        'role' => $badRole,
    ]);
    actingAs($user)
        ->get(route('organization.requests'))->assertRedirect(route('home'));
})->with([
    'admin',
    'manager',
    'volunteer'
]);

it('assert a correct data' , function () {
    actingAs($this->user);
    Livewire::test('organization.requests.requests-opportunities')
        ->assertSeeLivewire('organization.requests.requests-opportunities');
});

it('send a correct data' , function () {

    $op = Opportunity::factory(10)->create();
    $this->organization->opportunities()->saveMany($op);
    actingAs($this->user);

    Livewire::test('organization.requests.requests-opportunities')
        ->assertSee($op->first()->title);
});
