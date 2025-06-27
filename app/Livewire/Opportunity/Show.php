<?php

namespace App\Livewire\Opportunity;

use App\Models\Opportunity;
use App\Models\Request;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

class Show extends Component
{
    #[title('عطاء | فرصة تطوعية')]
    public ?Opportunity $opportunity;

    public $submitted ;
    public $showRequestForm = false ;

    public function mount(opportunity $opportunity)
    {
        $requests = Request::where('opportunity_id' , $opportunity->id)->get();

        if ($requests->contains('volunteer_id', auth()->user()?->volunteer->id)) {
            $this->submitted = $requests->firstWhere('volunteer_id', auth()->user()?->volunteer->id);
        } else {
            $this->submitted = false;
        }

        $this->opportunity = $opportunity;
    }

    #[on('toggle')]
    public function toggle()
    {
        $this->showRequestForm = !$this->showRequestForm;
    }

    #[on('sendRequestModel')]
    public function sendRequestModel()
    {
        $this->showRequestForm = false ;
    }


    public function render()
    {
        return view('livewire.opportunity.show' , [
            'opportunity' => $this->opportunity,
            'is_accepted' => $this->opportunity->volunteers()->find(auth()->user()->volunteer?->id),
        ]);
    }
}
