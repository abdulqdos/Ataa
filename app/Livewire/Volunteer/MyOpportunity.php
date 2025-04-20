<?php

namespace App\Livewire\Volunteer;

use App\Livewire\Notifications;
use App\Models\Notification;
use App\Models\Opportunity;
use Livewire\Component;
use Livewire\WithPagination;

class MyOpportunity extends Component
{
    use WithPagination;

    public $user , $searchText , $status , $start_date , $end_date = '';
    public $selectedOpportunity = null ;
    public $showDeleteBox = false  ;
    protected $queryString = [
        'searchText' => ['except' => ''],
        'status' => ['except' => ''],
        'start_date' => ['except' => ''],
        'end_date' => ['except' => '']
    ];

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function clearSearch()
    {
        $this->reset(['searchText', 'status', 'start_date', 'end_date']);
        $this->resetPage();
    }

    // Alerts Function
    public function toggleShowDeleteBox(Opportunity $opportunity)
    {
        $this->selectedOpportunity = $this->user->volunteer->opportunities->firstWhere('id', $opportunity->id);
        $this->showDeleteBox = true;
    }

    public function cancelRegistration()
    {
        if ($this->selectedOpportunity) {
            auth()->user()->volunteer->opportunities()->detach($this->selectedOpportunity->id);
            Notification::create([
               'user_id' =>  $this->selectedOpportunity->organization_id,
                'title' => 'إلغاء تسجيل متطوع',
                'message' =>  'بإلغاء تسجيله من الفرصة .'. auth()->user()->volunteer->first_name  .'لقد قام المتطوع'
            ]);
            $this->selectedOpportunity->update([
                'accepted_count' => $this->selectedOpportunity->accepted_count - 1,
            ]);
            $this->resetDeleteBox();
            return redirect()->route('volunteer.myOpportunity')->with('success', 'تم إلغاء تسجيلك بنجاح .');
        }

        session()->flash('error', 'لا توجد فرصة تطوعية محددة للحذف.');
    }

    public function resetDeleteBox()
    {
        $this->reset(['showDeleteBox', 'selectedOpportunity']);
    }


    public function render()
    {
        $query = $this->user->volunteer->opportunities()
            ->when($this->searchText, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->searchText . '%')
                        ->orWhere('description', 'like', '%' . $this->searchText . '%');
                });
            })
            ->when($this->status, function ($query) {
                $now = now();

                if ($this->status === 'upcoming') {
                    $query->where('start_date', '>', $now);
                } elseif ($this->status === 'active') {
                    $query->where('start_date', '<=', $now)
                        ->where('end_date', '>=', $now);
                } elseif ($this->status === 'completed') {
                    $query->where('end_date', '<', $now);
                }
            })
            ->when($this->start_date, function ($query) {
                $query->whereDate('start_date', '>=', $this->start_date);
            })
            ->when($this->end_date, function ($query) {
                $query->whereDate('end_date', '<=', $this->end_date);
            })
            ->orderBy('start_date', 'desc');

        $opportunities = $query->with('organization')->paginate(10);

        return view('livewire.volunteer.my-opportunity', [
            'opportunities' => $opportunities
        ]);
    }
}
