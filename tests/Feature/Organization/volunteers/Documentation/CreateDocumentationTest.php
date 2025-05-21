<?php

use App\Models\Opportunity;
use App\Models\User;
use App\Models\Volunteer;
use Illuminate\Http\UploadedFile;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

beforeEach(function () {
    $this->v = Volunteer::factory()->create();
    $this->op = Opportunity::factory()->create();

    $this->op->volunteers()->attach($this->v);
});
it('must be an organization', function ($badRole) {
    $user = User::factory()->create([
        'role' => $badRole,
    ]);

    actingAs($user);
    get(route('organization.volunteers.documentation.create' , ['opportunity' => $this->op , 'volunteer' => $this->v]))->assertRedirect('/');
})->with([
    'admin',
    'volunteer',
]);



it('assert a correct component', function () {
    Livewire::test('organization.volunteers.documentation.create'  , ['opportunity' => $this->op , 'volunteer' => $this->v] )
        ->assertSeeLivewire('organization.volunteers.documentation.create');
});

it('can a Document a Opportunity', function () {

    Livewire::test('organization.volunteers.documentation.create', ['opportunity' => $this->op , 'volunteer' => $this->v])
        ->set('description' , 'ساهم في حملة التبرع بالدم لمرضى فقر الدم')
        ->set('hours' , 2)
        ->set('participation_date' , now()->format('Y-m-d'))
        ->set('report' , 'كان عبدالقدوس من أفضل المتطوعين من حيث الانضباط والتعاون والفعالية، وأدى دوره بشكل ممتاز وملهم.') // أقل من 1000
        ->set('eval_commitment' , 4)
        ->set('eval_teamwork' , 5)
        ->set('eval_leadership' , 3)
        ->call('store');

    $this->assertDatabaseHas('volunteer_opportunities', [
        'description' => 'ساهم في حملة التبرع بالدم لمرضى فقر الدم',
        'hours' => 2,
        'participation_date' => now()->format('Y-m-d'),
        'report' =>  'كان عبدالقدوس من أفضل المتطوعين من حيث الانضباط والتعاون والفعالية، وأدى دوره بشكل ممتاز وملهم.',
        'eval_commitment' => 4,
        'eval_teamwork' => 5,
        'eval_leadership' => 3,
    ]);
});

it('can a redirect to correct page', function () {

    Livewire::test('organization.volunteers.documentation.create', ['opportunity' => $this->op , 'volunteer' => $this->v])
        ->set('description' , 'ساهم في حملة التبرع بالدم لمرضى فقر الدم')
        ->set('hours' , 2)
        ->set('participation_date' , now()->format('Y-m-d'))
        ->set('report' , 'كان عبدالقدوس من أفضل المتطوعين من حيث الانضباط والتعاون والفعالية، وأدى دوره بشكل ممتاز وملهم.') // أقل من 1000
        ->set('eval_commitment' , 4)
        ->set('eval_teamwork' , 5)
        ->set('eval_leadership' , 3)
        ->call('store')->assertRedirect(route('organization.volunteers' , ['opportunity' => $this->op ]));
});

