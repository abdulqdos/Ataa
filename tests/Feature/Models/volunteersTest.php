<?php

use App\Models\Opportunity;
use App\Models\Volunteer;

it('have a relational many to many with opportunity' , function () {
    $volunteer = Volunteer::factory()->create();
    $opportunities = Opportunity::factory(10)->create();
    $volunteer->opportunities()->attach($opportunities->pluck('id'));
    $this->assertCount(10, $volunteer->opportunities);
});
