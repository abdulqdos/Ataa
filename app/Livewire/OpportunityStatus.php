<?php

namespace App\Livewire;

use App\Models\Opportunity;
use Livewire\Component;

class OpportunityStatus extends Component
{
    public  $opportunity;

    public function mount(Opportunity $opportunity)
    {
        $this->updateOpportunityStatus();
        $this->opportunity = $opportunity;
    }

    public function updateOpportunityStatus()
    {
            $this->opportunity->updateStatus();
    }

    public function render()
    {
        return view('livewire.opportunity-status');
    }
}
