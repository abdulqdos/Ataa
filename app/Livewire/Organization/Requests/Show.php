<?php

namespace App\Livewire\Organization\Requests;
use App\Livewire\OrganizationComponent;
use App\Models\Request ;

class Show extends OrganizationComponent
{
    public $request ;

    public function mount(Request $request)
    {
        $this->request = $request ;
    }
    public function render()
    {
        return view('livewire.requests.show' , [
            'request' => $this->request,
        ]);
    }
}
