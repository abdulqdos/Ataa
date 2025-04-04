<?php

namespace App\Livewire\Opportunity;

use App\Models\Opportunity;
use App\Models\Request;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class RequestForm extends Component
{
    #[validate('required|string|min:10|max:256|regex:/^[^<>\/]*$/')]
    public $reason ;
    public $opportunity  ;

    protected $messages = [
      'reason.required' => 'يرجى كتابة السبب .',
      'reason.string' => 'يجب أن يكون السبب نصي .',
      'reason.min' => 'أقل عدد حروف ان يكون 10 .',
      'reason.max' => 'أكثر عدد حروف ان يكون 255 .',
      'reason.regx' => 'السبب لا يجب أن يحتوي على أكواد أو رموز غير مسموحة.',
    ];

    public function mount(Opportunity $opportunity)
    {
        $this->opportunity = $opportunity;
    }

    public function sendRequest()
    {
        $this->validate();

        Request::create([
            'reason' => $this->reason,
            'volunteer_id' => auth()->user()?->volunteer->id,
            'opportunity_id' => $this->opportunity->id,
        ]);

        $this->dispatch('sendRequestModel');

        return $this->redirect(route('opportunities.show', $this->opportunity));
    }


    public function render()
    {
        return view('livewire.opportunity.request-form');
    }
}
