<?php

namespace App\Livewire\Organization;

use App\Livewire\OrganizationComponent;
use Livewire\Attributes\Title;

class Dashboard extends OrganizationComponent
{
    #[Title('لوحة التحكم')]

    public $organization;
    public $opportunities;

    public function mount()
    {
        $this->organization = auth()->user()?->organization;
        $this->opportunities = $this->organization
            ->opportunities()
            ->latest()
            ->take(4)
            ->get();
    }

    public function render()
    {
        return view('livewire.organization.dashboard', [
            'opportunities' => $this->opportunities,

            'requests' => $this->opportunities->flatMap(function ($opportunity) {
                return $opportunity->requests;
            }),

            'volunteers' => $this->opportunities->flatMap(function ($opportunity) {
                return $opportunity->volunteers;
            }),
        ]);
    }
}
