<?php
use App\Models\User;
use App\Models\Request;
use function Pest\Laravel\actingAs;

beforeEach(function () {
        $this->organization = User::factory()->create([
            'role' => 'organization',
        ]);

        $this->request = Request::factory()->create();
});

it('must be an organization', function ($badRole) {
    $user = User::factory()->create([
        'role' => $badRole,
    ]);
    actingAs($user)->get(route('organization.opportunities-requests' , [ 'request' => $this->request ]))
    ->assertRedirect('/');
})->with([
    'admin',
    'volunteer',
]);

it('return a correct component', function () {
    Livewire::test('organization.requests.show' , ['request' => $this->request])->assertSeeLivewire('organization.requests.show');
});


it('return a correct request', function () {
    Livewire::test('organization.requests.show' , ['request' => $this->request])->assertSet('request' , $this->request);
});
