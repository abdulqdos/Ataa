<?php

namespace App\Livewire;

use App\Models\Notification;
use Livewire\Attributes\On;
use Livewire\Component;

class Notifications extends Component
{
    public $user, $showNotifications = false, $count;

    public function mount()
    {
        $this->user = auth()->user();
        $this->updateCount();
    }

    public function toggleShowNotifications()
    {
        $this->showNotifications = !$this->showNotifications;
    }

    #[On('closeNotifications')]
    public function closeNotifications()
    {
        $this->showNotifications = false;
    }

    public function updateNotifications()
    {
        $this->user->load('notifications');
        $this->updateCount();
    }

    public function makeAsRead($notificationId)
    {
        $notification = $this->user->notifications()->find($notificationId);

        if ($notification) {
            $notification->markAsRead();
            $this->updateNotifications();
        }
    }
    public function makeAllAsRead()
    {
        foreach ($this->user->notifications as $notification) {
            $notification->markAsRead();
        }

        $this->updateNotifications();
    }

    public function deleteAll()
    {
        foreach ($this->user->notifications as $notification) {
            $notification->delete();
        }

        $this->updateNotifications();
    }

    private function updateCount()
    {
        $this->count = $this->user->notifications()->whereNull('read_at')->count();
    }

    public function render()
    {
        return view('livewire.notifications', [
            'notifications' => $this->user->notifications,
            'unreadNotificationsCount' => Notification::whereNull('read_at')->count(),
            'count' => $this->count,
        ]);
    }
}

