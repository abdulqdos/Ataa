<?php

use App\Models\Opportunity;
use App\Models\User;
use Carbon\Carbon;
use function Pest\Laravel\actingAs;

beforeEach(function () {
    $this->organization = User::factory()->create(
        [
            'role' => 'organization',
        ]
    );

    $this->opportunity = Opportunity::factory()->recycle($this->organization)->create();
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


it('can update a opportunity', function () {
   actingAs($this->organization);

    Livewire::test('organization.opportunity.edit', ['opportunity' => $this->opportunity->id])
        ->set('title', 'عنوان جديد')
        ->set('description', 'وصف جديد وصف وصف وصف وصف')
        ->set('img', \Illuminate\Http\UploadedFile::fake()->image('test.jpg'))
        ->set('start_date', Carbon::createFromFormat('d-m-Y', '12-4-2025')->toDateString())
        ->set('end_date', Carbon::createFromFormat('d-m-Y', '25-4-2025')->toDateString())
        ->call('update');

    $this->assertDatabaseHas('opportunities', [
        'id' => $this->opportunity->id,
        'title' => 'عنوان جديد',
        'description' => 'وصف جديد وصف وصف وصف وصف',
        'start_date' => '2025-04-20',
        'end_date' => '2025-04-25',
    ]);
});
