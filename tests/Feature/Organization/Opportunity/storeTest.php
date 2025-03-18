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

it('can store an Opportunity', function () {

    actingAs($this->user);

    Livewire::test('organization.opportunity.create')
    ->set('title' , 'فرصة التعاونية')
    ->set('description' , 'فرصة التعاونية لي بناء مجتمع افضل')
    ->set('start_date' , '12-4-2025')
    ->set('end_date' , '15-4-2025')
    ->set('status' , 'available')
    ->set('img' , \Illuminate\Http\UploadedFile::fake()->image('test.jpg'))
    ->call('store');

    $this->assertDatabaseHas('opportunities', [
        'title' => 'فرصة التعاونية',
        'description' => 'فرصة التعاونية لي بناء مجتمع افضل',
        'start_date' => Carbon::createFromFormat('d-m-Y', '12-4-2025')->toDateString(),
        'end_date' => Carbon::createFromFormat('d-m-Y', '15-4-2025')->toDateString(),
        'status' => 'available',
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
        ->set('status' , 'available')
        ->set('img' , \Illuminate\Http\UploadedFile::fake()->image('test.jpg'))
        ->call('store')
        ->assertRedirect(route('organization.opportunity'));
});

// Validation Test
