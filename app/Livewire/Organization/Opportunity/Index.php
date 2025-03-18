<?php

namespace App\Livewire\Organization\Opportunity;

use App\Livewire\OrganizationComponent;
use App\Models\Opportunity;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends OrganizationComponent
{
    use  withPagination ;
    public function render()
    {
        $opportunities = Opportunity::where('organization_id' , auth()->user()->organization?->id)->paginate(10);
        return view('livewire.organization.opportunity.index' , [
            'opportunities' => $opportunities
        ]);
    }
}
