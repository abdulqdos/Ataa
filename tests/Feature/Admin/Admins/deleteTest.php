<?php

use App\Models\User;
use function Pest\Laravel\actingAs;

beforeEach(function () {
    $user = User::factory()->create([
        'role' => 'manager'
    ]);

    actingAs($user);
});

it('can delete a admin' , function () {
    User::factory(5)->create([
        'role' => 'admin'
    ]);

    Livewire::test('admin.admins')
        ->set('selectedAdmin' , User::find(2) )
        ->call('confirmDelete');

    $this->assertDatabaseMissing( 'users', [
        'id' => 2,
    ]);
});
