<?php

namespace App\Livewire\Organization\Volunteers;

use App\Livewire\AdminComponent;
use App\Livewire\OrganizationComponent;
use App\Models\Volunteer;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('المتطوع')]
class Show extends OrganizationComponent
{
    public $volunteer ;

    public function mount(Volunteer $volunteer)
    {
        $this->volunteer = $volunteer;
    }

    public function render()
    {
        return view('livewire.organization.volunteers.show' , [
            'volunteer' => $this->volunteer,
            'opportunities' => $this->volunteer->opportunities,
        ]);
    }
}
