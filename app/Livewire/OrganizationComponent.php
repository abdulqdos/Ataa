<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[layout('components.layouts.oraganization')]
class OrganizationComponent extends Component
{
    public function render()
    {
        return view('livewire.organization.dashboard');
    }
}
