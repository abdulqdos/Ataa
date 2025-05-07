<?php

namespace App\Livewire;

use App\Models\Volunteer;
use Livewire\Component;

class Volunteers extends Component
{
    public $volunteers ;

    public function mount()
    {
        $this->volunteers = Volunteer::all();
    }
    public function render()
    {
        return view('livewire.volunteers' , [
            'volunteers' => $this->volunteers
        ]);
    }
}
