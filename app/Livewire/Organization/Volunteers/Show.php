<?php

namespace App\Livewire\Organization\Volunteers;

use App\Models\Volunteer;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('المتطوع')]
class Show extends Component
{
    public $volunteer ;

    public function mount(Volunteer $volunteer)
    {
        $this->volunteer = $volunteer;
    }

    public function render()
    {
        return view('livewire.organization.volunteers.show' , [
            'volunteer' => $this->volunteer
        ]);
    }
}
