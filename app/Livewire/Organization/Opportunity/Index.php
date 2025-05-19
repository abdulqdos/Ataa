<?php

namespace App\Livewire\Organization\Opportunity;

use App\Livewire\OrganizationComponent;
use App\Models\Opportunity;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

#[Title('إدارة الفرص التطوعية')]
class Index extends OrganizationComponent
{
    use WithPagination;

    #[Url(as: 'q', except: '')]

    public $searchText;
    public $start_date, $end_date , $status;
    public $showDeleteBox = false;
    public $selectedOpportunity = null; // لتخزين ID الفرصة المراد حذفها

    public function updated()
    {
        $this->resetPage();
    }
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
        if (!$this->selectedOpportunity) {
            session()->flash('error', 'لا توجد فرصة تطوعية محددة للحذف.');
            return;
        }

        $this->selectedOpportunity->delete();
        $this->reset(['selectedOpportunity']);
        return redirect()->route('organization.opportunity')->with('success', 'تم حذف الفرصة التطوعية بنجاح');
    }

    public function resetDeleteBox()
    {
        $this->showDeleteBox = false;
        $this->selectedOpportunity = null;
    }

    public function getOpportunities()
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
            $now = now();

            if ($this->status === 'upcoming') {
                $query->where('start_date', '>', $now);
            } elseif ($this->status === 'active') {
                $query->where('start_date', '<=', $now)
                    ->where('end_date', '>=', $now);
            } elseif ($this->status === 'completed') {
                $query->where('end_date', '<', $now);
            }
        }

        return $query ;
    }

    public function render()
    {
        $query = $this->getOpportunities();

        return view('livewire.organization.opportunity.index', [
            'opportunities' => $query->latest()->paginate(10),
        ]);
    }
}
