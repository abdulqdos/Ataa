<?php

use App\Models\Opportunity;
use App\Models\User;

it('can delete an opportunity', function () {
    $opportunity = Opportunity::factory()->create();
    \Pest\Laravel\actingAs(User::factory()->create(['role' => 'organization']));
    Livewire::test('organization.opportunity')
        ->call('confirmDelete', $opportunity);
    $this->assertDatabaseMissing('opportunities', $opportunity->toArray());
});
