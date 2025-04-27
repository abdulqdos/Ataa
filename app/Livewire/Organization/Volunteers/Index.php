<?php

namespace App\Livewire\Organization\Volunteers;
use App\Livewire\OrganizationComponent;
use App\Models\Volunteer;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

class Index extends organizationComponent
{
    use WithPagination;
    #[title('إدارة المتطوعين ')]
    public $organization ;
    public function mount()
    {
        $this->organization = auth()->user()->organization;
    }

    public function getVolunteers()
    {
        $organization = $this->organization;
        return Volunteer::whereHas('opportunities', function ($query) use ($organization) {
            $query->where('organization_id', $organization->id);
        });
    }

    public function render()
    {
        $volunteers = $this->getVolunteers();

        return view('livewire.organization.volunteers.index' , [
            'volunteers' => $volunteers->paginate(10),
        ]);
    }
}
