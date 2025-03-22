<?php

use App\Models\Opportunity;
use function Pest\Laravel\get;

it('must be a correct component', function () {
    get(route('opportunities'))->assertSeeLivewire('opportunities');
});


it('must send opportunities data', function () {
    Opportunity::factory()->count(15)->create();

    Livewire::test('opportunities')
        ->assertSet('opportunities.data', Opportunity::latest()->take(12)->get()->toArray())
        ->assertSet('opportunities.current_page', 1)
        ->assertSet('opportunities.last_page', ceil(Opportunity::count() / 12));
});

