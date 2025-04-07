<?php

namespace App\Livewire\Authentication\UpdateProfile;

use Livewire\Component;

class Volunteer extends Component
{
    public $user ;

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function render()
    {
        return view('livewire.authentication.update-profile.volunteer');
    }
}
