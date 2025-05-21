<?php

use App\Models\Opportunity;
use App\Models\Volunteer;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

beforeEach(function () {
   $this->opportunity = Opportunity::factory()->create();
   $this->user = User::factory()->create();
   $this->volunteer = Volunteer::factory()->recycle($this->user)->create();
});

it('must be a correct component', function () {
    actingAs($this->user);
    Livewire::test('opportunity.show' , ['opportunity' => $this->opportunity])->assertSeeLivewire('opportunity.show');
});

it('sent a data', function () {
    actingAs($this->user);
    Livewire::test('opportunity.show', ['opportunity' => $this->opportunity])
        ->assertSet('opportunity', $this->opportunity);
});

it('can send request', function () {

    $this->withoutExceptionHandling();
    actingAs($this->user);

    Livewire::test('opportunity.request-form', ['opportunity' => $this->opportunity])
        ->set('reason' , 'bla bla bla bla bla')
        ->set('opportunity', $this->opportunity)
        ->call('sendRequest');

    $this->assertDatabaseCount('opportunities', 1);
});


it('invalid reason', function ($badReason) {

    actingAs($this->user);

    Livewire::test('opportunity.request-form', ['opportunity' => $this->opportunity])
        ->set('reason' , $badReason)
        ->set('opportunity', $this->opportunity)
        ->call('sendRequest')
        ->assertHasErrors(['reason']);
})->with([
    'aaa',
    str_repeat('b', 257),
    1,
    1.5,
    null,
    '<script src="wdwdw"> </script>'
]);
