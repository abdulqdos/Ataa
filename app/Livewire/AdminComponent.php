<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[layout('components.layouts.admin')]
class AdminComponent extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
