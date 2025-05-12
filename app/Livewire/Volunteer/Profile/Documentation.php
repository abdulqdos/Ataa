<?php

namespace App\Livewire\Volunteer\Profile;

use App\Models\Opportunity;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('مشاركتي')]
class Documentation extends Component
{
    public $opportunity , $organization;
    public function mount(Opportunity $opportunity)
    {
        $this->opportunity = DB::table('volunteer_opportunities')
            ->where('opportunity_id', $opportunity->id)
            ->Where('volunteer_id' , auth()->user()->volunteer->id)
            ->first();

        $this->organization = $opportunity->organization ;
    }
    public function render()
    {
        return view('livewire.volunteer.profile.documentation' ,
        [
            'opportunity' => $this->opportunity,
            'organization' => $this->organization
        ]);
    }
}
