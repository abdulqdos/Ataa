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

    Livewire::test('organization.opportunity.edit', ['opportunity' => $this->opportunity])
        ->set('title' , 'فرصة التعاونية')
        ->set('description' , 'فرصة التعاونية لي بناء مجتمع افضل')
        ->set('start_date' , '12-4-2025')
        ->set('end_date' , '15-4-2025')
        ->set('img' , \Illuminate\Http\UploadedFile::fake()->image('test.jpg'))
        ->set('location' , 'شارع زاوية مقابل مستشفى')
        ->set('location_url' , 'https://maps.app.goo.gl/Jy5ZXan9LhSrxERCA')
        ->set('count' , 200)
        ->call('update');
    $this->assertDatabaseCount('opportunities',1);
});
