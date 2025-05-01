<?php

namespace App\Livewire\Organization\Volunteers;

use App\Livewire\OrganizationComponent;
use App\Models\Opportunity;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Title('إدارة المتطوعون - قائمة المتطوعون')]
class Index extends organizationComponent
{
    use withPagination ;
    public $opportunity  , $searchText , $status ;

    public function mount(Opportunity $opportunity)
    {
        $this->opportunity = $opportunity;
        $this->status = $this->opportunity->getStatus();
    }

    public function updated()
    {
        $this->resetPage();
    }

    #[On('search:clear')]
    public function clear()
    {
        $this->reset('searchText', 'status');
    }

    public function getVolunteers()
    {
        $query = $this->opportunity->volunteers()->withPivot('hours');

        if(!empty($this->searchText))
        {
            $query->where('first_name', 'like', '%' . $this->searchText . '%')->orWhere('last_name', 'like', '%' . $this->searchText . '%');
        }

        return $query ;
    }


    public function render()
    {
        $volunteers = $this->getVolunteers();
        return view('livewire.organization.volunteers.index' , [
            'volunteers' => $volunteers->latest()->paginate(10),
            'opportunity' => $this->opportunity,
            'status' =>  $this->status
        ]);
    }
}
