<?php

namespace App\Livewire\Volunteer;

use App\Models\Opportunity;
use Livewire\Component;
use Livewire\WithPagination;

class MyOpportunity extends Component
{
    use WithPagination;

    public $user;
    public $searchText = '';
    public $status = '';
    public $start_date = '';
    public $end_date = '';

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

    public function clearFilters()
    {
        $this->reset(['searchText', 'status', 'start_date', 'end_date']);
        $this->resetPage();
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
                $query->where('status', $this->status);
            })
            ->when($this->start_date, function ($query) {
                $query->whereDate('start_date', '>=', $this->start_date);
            })
            ->when($this->end_date, function ($query) {
                $query->whereDate('end_date', '<=', $this->end_date);
            })
            ->orderBy('start_date', 'desc');

        $opportunities = $query->paginate(10);

        return view('livewire.volunteer.my-opportunity', [
            'opportunities' => $opportunities
        ]);
    }
}
