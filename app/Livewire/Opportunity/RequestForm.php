<?php

namespace App\Livewire\Opportunity;

use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class RequestForm extends Component
{
//    #[validate('string|min:10|max:256')]
    public $reason ;


    public function sendRequest()
    {
        // code ...
        $this->dispatch('sendRequest');
    }



    public function render()
    {
        return view('livewire.opportunity.request-form');
    }
}
