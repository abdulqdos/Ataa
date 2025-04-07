<?php

use App\Models\User;
use App\Models\Notification;
use function Pest\Laravel\actingAs;

it('make notification As Read', function () {
    $user = User::factory()->create(['role' => 'volunteer']);
    Notification::factory()->recycle($user)->create();
    $notification = $user->notifications()->first();
    $notification->markAsRead();
    $this->assertDatabaseHas('notifications', [
        'read_at' => now()->toDateTimeString(),
    ]);
});

