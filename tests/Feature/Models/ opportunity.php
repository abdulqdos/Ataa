<?php

use App\Models\Opportunity;
use App\Models\Volunteer;

it('have a relational many to many with volunteer' , function () {
    $opportunity= Opportunity::factory()->create();
    $volunteers = Volunteer::factory(10)->create();
    $opportunity->volunteers()->attach($volunteers->pluck('id'));
    $this->assertCount(10, $opportunity->volunteers);
});
