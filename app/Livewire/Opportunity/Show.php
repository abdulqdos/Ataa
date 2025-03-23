<?php

namespace App\Livewire\Opportunity;

use App\Models\Opportunity;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

class Show extends Component
{
    #[title('عطاء | فرصة تطوعية')]
    public ?Opportunity $opportunity;
    public $showRequestForm = false ;

    public function mount(opportunity $opportunity)
    {
        $this->opportunity = $opportunity;
    }

    #[on('toggle')]
    public function toggle()
    {
        $this->showRequestForm = !$this->showRequestForm;
    }

    #[on('sendRequest')]
    public function sendRequest()
    {
        $this->showRequestForm = false ;
    }


    public function render()
    {
        return view('livewire.opportunity.show' , [
            'opportunity' => $this->opportunity,
        ]);
    }
}
