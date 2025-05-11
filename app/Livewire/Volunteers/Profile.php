<?php

namespace App\Livewire\Volunteers;

use App\Models\Volunteer;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('الملف الشخصي')]
class Profile extends Component
{
    public $volunteer;
    public function mount(Volunteer $volunteer)
    {
        $this->volunteer = $volunteer;
    }
    public function render()
    {
        return view('livewire.volunteers.profile' , [
            'volunteer' => $this->volunteer,
        ]);
    }
}
