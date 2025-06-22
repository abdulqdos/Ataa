<?php

namespace App\Livewire\Admin;

use App\Livewire\AdminComponent;
use App\Models\Opportunity;
use App\Models\Organization;
use App\Models\Volunteer;

class Dashboard extends AdminComponent
{
    public function render()
    {
        return view('livewire.admin.dashboard' , [
            'opportunities' => Opportunity::all(),
            'volunteers' => Volunteer::all(),
            'organizations' => Organization::all(),
        ]);
    }
}
