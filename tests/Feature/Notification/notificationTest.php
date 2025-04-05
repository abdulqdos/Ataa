<?php

use App\Models\User;
use App\Models\Notification;
use function Pest\Laravel\actingAs;
//
//it('make notification As Read', function () {
//    $user = User::factory()->create(['role' => 'volunteer']);
//    actingAs($user);
//
//    $notification = Notification::factory()->recycle($user)->create();
//
//    Livewire::test('notifications')
//        ->call('makeAsRead' , ['notificationId' => $notification->id]);
//
//    $this->assertDatabaseHas('notifications', [
//        'read_at' => now()->toDateTimeString(),
//    ]);
//});
