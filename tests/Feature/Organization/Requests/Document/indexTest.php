<?php

use App\Models\Organization;
use App\Models\User;
use App\Models\Request;
use Illuminate\Pagination\LengthAwarePaginator;
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
it('return a correct data' , function () {
   Livewire::test('organization.requests.document.index')
        ->assertSeeLivewire('organization.requests.document');
});
it('it send a correct data' , function () {
    Livewire::test('organization.requests.document.index')
        ->assertViewHas('requests', function ($value) {
            return $value instanceof LengthAwarePaginator;
        });
});
