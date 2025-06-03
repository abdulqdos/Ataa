<?php

namespace App\Livewire\Organization\Requests\Document;

use App\Livewire\OrganizationComponent;
use App\Models\Opportunity;
use App\Models\Organization;
use App\Models\Request;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

#[Title('طلبات التوثيق')]
class Index extends OrganizationComponent
{
    use withPagination;
    #[Url(as: 'q', except: '')]
    public $searchText  ;

    public function updated()
    {
        $this->resetPage();
    }

    #[On('search:clear')]
    public function clear()
    {
        $this->reset('searchText');
    }
    public $opportunity;
    public function mount(Opportunity $opportunity)
    {
        $this->opportunity = $opportunity;
    }

    public function getRequests()
    {
        $query = $this->opportunity->requests();

        if (!empty($this->searchText)) {
            $query->whereHas('volunteer', function ($q) {
                $q->where('first_name', 'like', '%' . $this->searchText . '%')
                    ->orWhere('last_name', 'like', '%' . $this->searchText . '%');
            });
        }

        return $query ;
    }
    public function render()
    {
        return view('livewire.organization.requests.document.index' , [
            'requests' => $this->getRequests()->where('opportunity_id' , $this->opportunity->id)->paginate(5),
        ]);
    }
}
