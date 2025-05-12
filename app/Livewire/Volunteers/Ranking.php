<?php

namespace App\Livewire\Volunteers;

use App\Models\Opportunity;
use App\Models\Volunteer;
use Livewire\Component;
use Livewire\WithPagination;

class Ranking extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.volunteers.ranking' , [
            'volunteers' =>  Volunteer::orderByDesc('eval_avg')->paginate(10),
            'totalVolunteers' => Volunteer::all()->count(),
            'totalOpportunities' => Opportunity::all()->count(),
        ]);
    }
}
