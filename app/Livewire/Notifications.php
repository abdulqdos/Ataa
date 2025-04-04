<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class Notifications extends Component
{
    public $user , $showNotifications = false  , $count ;
    public function mount()
    {
        $this->user = auth()->user();
        $this->count =  $this->user->notifications()->whereNull('read_at')->count();
    }

    public function toggleShowNotifications()
    {
        $this->showNotifications = !$this->showNotifications ;
    }

    #[on('closeNotifications')]
    public function closeNotifications()
    {
        $this->showNotifications = false;
    }

    public function render()
    {
        return view('livewire.notifications' , [
            'notifications' => $this->user->notifications,
            'count' => $this->count,
        ]);
    }
}
