<?php

use App\Models\Opportunity;
use App\Models\Organization;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

beforeEach(function () {
   $this->organization = User::factory()->create(
       [
           'role' => 'organization',
       ]
   );

   $this->org = Organization::factory()->recycle($this->organization)->create();

   $this->opportunities = Opportunity::factory(10)->recycle($this->org)->create();
});

it('must be a organization' , function($badRole){
   $user = User::factory()->create(
       [
           'role' => $badRole,
       ]
   );
    actingAs($user);
    get(route('organization.opportunities-volunteers'))->assertRedirect('/');
})->with([ 'admin' , 'volunteer' ]);



it('return a correct component' , function(){
    actingAs($this->organization);
  Livewire::test('organization.volunteers.opportunities-volunteers')
      ->assertSeeLivewire('organization.volunteers.opportunities-volunteers');
});

it('See a correct opportunity' , function(){
    actingAs($this->organization);
    Livewire::test('organization.volunteers.opportunities-volunteers')
        ->assertSee($this->org->opportunities()->first()->title);
});
