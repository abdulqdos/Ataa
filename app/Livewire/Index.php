<?php

namespace App\Livewire;

use App\Models\Opportunity;
use App\Models\Volunteer;
use App\Models\VolunteerOpportunity;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title(' عطاء - للأعمال التطوعية')]
class Index extends Component
{
    public function render()
    {

        $opportunities = Opportunity::latest()->take(3)->get();


        $volunteersCount = \App\Models\Volunteer::count();


        $opportunitiesCount = Opportunity::count();


        $totalHours = VolunteerOpportunity::sum('hours');

        return view('livewire.index', [
            'opportunities' => $opportunities,
            'volunteersCount' => $volunteersCount,
            'opportunitiesCount' => $opportunitiesCount,
            'totalHours' => $totalHours,
        ]);
    }
}
