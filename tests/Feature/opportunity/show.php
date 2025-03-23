<?php

use App\Models\Opportunity;
use function Pest\Laravel\get;

beforeEach(function () {
   $this->opportunity = Opportunity::factory()->create();
});

it('must be a correct component', function () {
    get(route('opportunities.show' , $this->opportunity))->assertSeeLivewire('opportunity.show');
});

it('sent a data', function () {
    Livewire::test('opportunity.show', ['opportunity' => $this->opportunity])
        ->assertSet('opportunity', $this->opportunity);
});
