<?php


use App\Models\Opportunity;
use App\Models\User;
use function Pest\Laravel\actingAs;

it('can delete an opportunity', function () {
    $opportunity = Opportunity::factory()->create();
    actingAs(User::factory()->create(['role' => 'organization']));
    Livewire::test('organization.opportunity')
        ->call('confirmDelete', $opportunity);
    $this->assertDatabaseMissing('opportunities', $opportunity->toArray());
});
