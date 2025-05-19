<?php

use App\Models\Opportunity;
use App\Models\Organization;
use App\Models\User;
use Carbon\Carbon;
use function Pest\Laravel\actingAs;

beforeEach(function () {
    $this->organization = User::factory()->create(
        [
            'role' => 'organization',
        ]
    );

    $this->opportunity = Opportunity::factory()->recycle(Organization::factory()->recycle($this->organization)->create())->create();
});

it('must be an organization', function ($badRole) {
    $user = User::factory()->create(
        [
            'role' => $badRole,
        ]
    );

    actingAs($user)
        ->get(route('organization.opportunity.edit', $this->opportunity->id))->assertRedirect('/');
})->with([
    'admin',
    'volunteer',
]);

it('must be return a correct component' , function () {
    actingAs($this->organization)->get(route('organization.opportunity.edit', $this->opportunity->id))->assertSeeLivewire('organization.opportunity.edit');
});
