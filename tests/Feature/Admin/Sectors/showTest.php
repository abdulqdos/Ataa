<?php

use App\Models\Organization;
use App\Models\Sector;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use function Pest\Laravel\actingAs;

beforeEach(function () {
    $this->sector = Sector::factory()->create();

    Organization::factory(10)->recycle($this->sector)->create();
});

it('must be an admin' ,  function ($badRole) {
    $user = User::factory()->create(
        [
            'role' => $badRole,
        ]
    );
    actingAs($user)
        ->get(route('admin.sectors.show', $this->sector->id))->assertRedirect(route('home'));
})->with([
    'volunteer',
    'organization'
]);


it('return a correct component' ,  function () {
    Livewire::test('admin.sectors.show', ['sector' => $this->sector])
        ->assertSeeLivewire('admin.sectors.show');
});

it('set a correct data' ,  function () {
    Livewire::test('admin.sectors.show', ['sector' => $this->sector])
        ->assertSet('sector' , $this->sector);
});

it('assert a correct organizations' ,  function () {
    Livewire::test('admin.sectors.show', ['sector' => $this->sector])
        ->assertViewHas('organizations', function ($value) {
            return $value instanceof LengthAwarePaginator;
        });
});

it('assert a correct opportunities' ,  function () {
    Livewire::test('admin.sectors.show', ['sector' => $this->sector])
        ->assertViewHas('opportunities', function ($value) {
            return $value instanceof LengthAwarePaginator;
        });
});
