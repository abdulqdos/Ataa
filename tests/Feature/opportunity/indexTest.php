<?php

use App\Models\Opportunity;
use function Pest\Laravel\get;

it('must be a correct component', function () {
    Opportunity::factory(20)->create();
    Livewire::test('opportunity.index')->assertSeeLivewire('opportunity');
});

