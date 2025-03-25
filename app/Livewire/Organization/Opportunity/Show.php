<?php

namespace App\Livewire\Organization\Opportunity;

use App\Livewire\OrganizationComponent;
use App\Models\Opportunity;
use App\Models\Request;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class Show extends OrganizationComponent
{
    use WithPagination;

    #[Url(as: 'q', except: '')]
    #[title('الفرصة التطوعية')]

    public ?Opportunity $opportunity ;

    public $filterStatus ;

    public function mount(Opportunity $opportunity)
    {
        $this->opportunity = $opportunity;
    }

    public function render()
    {
        $query = Request::where('opportunity_id' , $this->opportunity->id);

        if (!empty($this->filterStatus)) {
            $query->where('status', $this->filterStatus);
        }

        return view('livewire.organization.opportunity.show' , [
            'opportunity' => $this->opportunity,
            'requests' => $query->paginate(5),
        ]);
    }
}
