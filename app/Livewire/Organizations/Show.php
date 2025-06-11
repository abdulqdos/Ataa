<?php

namespace App\Livewire\Organizations;

use App\Models\Organization;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title("تفاصيل مؤسسة")]
class Show extends Component
{
    public  $organization;
    public function mount(Organization $organization)
    {
           $this->organization = $organization;
    }

    public function render()
    {
        return view('livewire.organizations.show' , [
            'organization' => $this->organization
        ]);
    }
}
