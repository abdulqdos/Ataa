<?php

use App\Livewire\Volunteer\Profile\Documentation;
use App\Models\Opportunity;
use App\Models\User;
use App\Models\Volunteer;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

beforeEach(function () {
    $this->user = User::factory()->create([ 'role' => 'volunteer' ]);
    Opportunity::factory()->create();
    $this->v = Volunteer::factory()->recycle($this->user)->create();
    $this->v->opportunities()->attach(Opportunity::factory()->create());
    $this->op = $this->v->opportunities()->first()->id;
});

it('must be a volunteer' , function ($badRole) {
    $user = User::factory()->create([
        'role' => $badRole,
    ]);

    Opportunity::factory()->create();
    actingAs($user);
    get(route('volunteers.myOpportunity.documentation' , 1))->assertRedirect(route('home'));
})->with([
    'admin'
]);

it('can a make request to document' , function () {
    actingAs($this->user);

    Livewire::test(Documentation::class , ['opportunity' => $this->op ])
        ->set('id' , $this->op)
        ->call('makeRequest');

    $this->assertDatabaseCount('requests', 1);
});
