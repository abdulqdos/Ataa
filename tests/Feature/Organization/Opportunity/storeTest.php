<?php

use App\Models\Organization;
use App\Models\User;
use Carbon\Carbon;
use function Pest\Laravel\actingAs;

beforeEach(function () {
    $this->user = User::factory()->create([
       'role' => 'organization',
   ]);

    Organization::factory()->recycle($this->user)->create();
});


it('must be an organization', function ($badRole) {
    $user = User::factory()->create([
        'role' => $badRole,
    ]);
    actingAs($user)
        ->get(route('organization.opportunity.create'))->assertRedirect(route('home'));
})->with([
    'volunteer',
    'admin'
]);

it('return a correct component' , function () {
    $user = User::factory()->create([
        'role' => 'organization',
    ]);

    actingAs($user)
        ->get(route('organization.opportunity.create'))->assertSeeLivewire('organization.opportunity.create');
});

it('can store an Opportunity', function () {

    actingAs($this->user);

    $this->withoutExceptionHandling();
    Livewire::test('organization.opportunity.create')
        ->set('title' , 'فرصة التعاونية')
        ->set('description' , 'فرصة التعاونية لي بناء مجتمع افضل')
        ->set('start_date' , '2025-04-12')
        ->set('end_date' , '2025-04-15')
        ->set('img' , \Illuminate\Http\UploadedFile::fake()->image('test.jpg'))
        ->set('location' , 'شارع زاوية مقابل مستشفى')
        ->set('location_url' , 'https://maps.app.goo.gl/Jy5ZXan9LhSrxERCA')
        ->set('count' , 200)
        ->call('store');

    $this->assertDatabaseHas('opportunities', [
        'title' => 'فرصة التعاونية',
        'description' => 'فرصة التعاونية لي بناء مجتمع افضل',
        'start_date' => '2025-04-12',
        'end_date' => '2025-04-15',
        'location' => 'شارع زاوية مقابل مستشفى',
        'location_url' => 'https://maps.app.goo.gl/Jy5ZXan9LhSrxERCA',
        'count' => 200,
    ]);
});


it('Redirect to correct page', function () {

    actingAs($this->user)
    ->get(route('organization.opportunity.create'));

    Livewire::test('organization.opportunity.create')
        ->set('title' , 'فرصة التعاونية')
        ->set('description' , 'فرصة التعاونية لي بناء مجتمع افضل')
        ->set('start_date' , '12-4-2025')
        ->set('end_date' , '15-4-2025')
        ->set('img' , \Illuminate\Http\UploadedFile::fake()->image('test.jpg'))
        ->set('location' , 'شارع زاوية مقابل مستشفى')
        ->set('location_url' , 'https://maps.app.goo.gl/Jy5ZXan9LhSrxERCA')
        ->set('count' , 200)
        ->call('store')
        ->assertRedirect(route('organization.opportunity'));
});

// Validation Test
it('invalid title', function ($badTitle) {
    actingAs($this->user);

    Livewire::test('organization.opportunity.create')
        ->set('title' , $badTitle)
        ->set('description' , 'فرصة التعاونية لي بناء مجتمع افضل')
        ->set('start_date' , '12-4-2025')
        ->set('end_date' , '15-4-2025')
        ->set('img' , \Illuminate\Http\UploadedFile::fake()->image('test.jpg'))
        ->call('store')
        ->assertHasErrors(['title']);
})->with([
    1,
    1.5,
    null,
    'aaa'.
    str_repeat('a' , 21),
    '<script>'
]);

it('invalid Description', function ($badDescription) {
    actingAs($this->user);

    Livewire::test('organization.opportunity.create')
        ->set('title' , 'فرصة تطوعية')
        ->set('description' , $badDescription)
        ->set('start_date' , '12-4-2025')
        ->set('end_date' , '15-4-2025')
        ->set('img' , \Illuminate\Http\UploadedFile::fake()->image('test.jpg'))
        ->call('store')
        ->assertHasErrors(['description']);
})->with([
    1,
    1.5,
    null,
    'aaa'.
    str_repeat('a' , 256),
    '<script>'
]);

it('invalid start date', function ($badStartDate) {
    actingAs($this->user);

    Livewire::test('organization.opportunity.create')
        ->set('title', 'فرصة تطوعية')
        ->set('description', 'وصف قصير')
        ->set('start_date', $badStartDate)
        ->set('end_date', '15-4-2025')
        ->set('img', \Illuminate\Http\UploadedFile::fake()->image('test.jpg'))
        ->call('store')
        ->assertHasErrors(['start_date']);
})->with([
    '',
    '32-12-2025',
    '2025-13-01',
    '15-04-2024',
    'abc',
]);

it('invalid end date', function ($badEndDate) {
    actingAs($this->user);

    Livewire::test('organization.opportunity.create')
        ->set('title', 'فرصة تطوعية')
        ->set('description', 'وصف قصير')
        ->set('start_date', '12-4-2025')
        ->set('end_date', $badEndDate)
        ->set('img', \Illuminate\Http\UploadedFile::fake()->image('test.jpg'))
        ->call('store')
        ->assertHasErrors(['end_date']);
})->with([
    '',
    '31-02-2025',
    '2025-14-04',
    '11-04-2025',
    'xyz',
]);

