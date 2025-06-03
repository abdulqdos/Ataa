<?php

use App\Models\Organization;
use App\Models\User;
use function Pest\Laravel\actingAs;

beforeEach(function () {
    $this->user = User::factory()->create([
        'role' => 'organization',
    ]);
    $this->organization = Organization::factory()->recycle($this->user)->create();
    $this->request = Request::factory()->create();
});

it('must be an organization', function ($badRole) {
    $user = User::factory()->create([
        'role' => $badRole,
    ]);
    actingAs($user)
        ->get(route('organization.opportunities-requests'));
})->with([
    'admin',
    'user'
]);
