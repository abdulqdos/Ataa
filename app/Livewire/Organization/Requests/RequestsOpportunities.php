<?php

namespace App\Livewire\Organization\Requests;

use App\Livewire\OrganizationComponent;
use App\Models\Opportunity;
use App\Models\Organization;
use App\Models\Request;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('إدارة طلبات')]
class RequestsOpportunities extends OrganizationComponent
{
    use withPagination ;
    #[Url(as: 'q', except: '')]
    public $searchText , $status , $organization;

    public function updated()
    {
        $this->resetPage();
    }

    #[On('search:clear')]
    public function clear()
    {
        $this->reset('searchText', 'status');
    }

    public function mount()
    {
        $this->organization = auth()->user()->organization;
    }

    public function getOpportunities()
    {
        $query = $this->organization->opportunities();

        if(!empty($this->searchText))
        {
            $query->where('title', 'LIKE', '%' . $this->searchText . '%');
        }


        return $query ;
    }


    public function render()
    {
        return view('livewire.organization.requests.requests-opportunities' , [
            'opportunities' => $this->getOpportunities()->where('end_date', '<', now())->paginate(12),
        ]);
    }
}
