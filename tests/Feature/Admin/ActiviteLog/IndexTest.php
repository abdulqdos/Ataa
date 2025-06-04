<?php

use App\Models\Opportunity;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\Activitylog\Models\Activity;
use function Pest\Laravel\actingAs;

beforeEach(function () {
    Opportunity::factory(20)->create();
    Activity::all();
});

it('must be an admin' , function ($badRole) {
    $user = User::factory()->create([
        'role' => $badRole,
    ]);
    actingAs($user)
        ->get(route('admin.activityLogs'))->assertRedirect(route('home'));
})->with([
    'volunteer',
    'organization'
]);

it('Assert a correct component' , function () {
    Livewire::test('admin.activity-log.index')
        ->assertSeeLivewire('admin.activity-log');
});

it('can send a data' , function () {
   Livewire::test('admin.activity-log.index')
        ->assertViewHas('activities', function ($value) {
            return $value instanceof LengthAwarePaginator ;
        });
});
