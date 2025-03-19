<?php

namespace App\Livewire\Organization\Opportunity;

use App\Livewire\OrganizationComponent;
use App\Models\Opportunity;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends OrganizationComponent
{
    use WithPagination;

    #[Title('الفرص التطوعية')]
    #[Url(as: 'q', except: '')]

    public $searchText;
    public $start_date, $end_date , $status;
    public $showDeleteBox = false;
    public $selectedOpportunity = null; // لتخزين ID الفرصة المراد حذفها

    #[On('search:clear')]
    public function clear()
    {
        $this->reset('searchText', 'start_date', 'end_date' , 'status');
    }

    public function toggleShowDeleteBox(Opportunity $opportunity)
    {
        $this->selectedOpportunity = $opportunity;
        $this->showDeleteBox = true;
    }

    public function confirmDelete()
    {
        if ($this->selectedOpportunity) {
            $this->selectedOpportunity->delete();
            $this->resetPage();
            $this->resetDeleteBox();
        }
    }

    public function resetDeleteBox()
    {
        $this->showDeleteBox = false;
        $this->selectedOpportunity = null;
    }

    public function render()
    {
        $query = Opportunity::where('organization_id', auth()->user()->organization?->id);

        if (!empty($this->searchText)) {
            $query->where('title', 'LIKE', '%' . $this->searchText . '%');
        }

        if (!empty($this->start_date)) {
            $query->where('start_date', '>=', $this->start_date);
        }

        if (!empty($this->end_date)) {
            $query->where('end_date', '>=', $this->end_date);
        }

        if (!empty($this->status)) {
            $query->where('status', $this->status);
        }

        return view('livewire.organization.opportunity.index', [
            'opportunities' => $query->paginate(10),
        ]);
    }
}
