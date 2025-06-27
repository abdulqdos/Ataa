<?php

namespace App\Livewire;

use App\Models\Opportunity;
use App\Models\Organization;
use App\Models\Volunteer;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title(' عطاء - للأعمال التطوعية')]
class Index extends Component
{
    public function render()
    {

        $opportunities = Opportunity::latest()->take(3)->get();


        $volunteersCount = Volunteer::count();


        $opportunitiesCount = Opportunity::count();

        $organization = Organization::all();

        return view('livewire.index', [
            'opportunities' => $opportunities,
            'volunteersCount' => $volunteersCount,
            'opportunitiesCount' => $opportunitiesCount,
            'organizationCount' => $organization->count(),
        ]);
    }
}
