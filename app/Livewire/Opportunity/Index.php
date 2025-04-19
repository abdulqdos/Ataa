<?php

namespace App\Livewire\Opportunity;

use App\Models\Opportunity;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class index extends Component
{
    use withPagination;
    #[Title('الفرص التطوعية')]
    #[Url(as: 'q', except: '')]
    public $searchText;
    public $start_date, $end_date, $status;
    public $header ;

    public function mount($header = 'none')
    {
        $this->header = 'كل الفرص';
    }

    #[On('search:clear')]
    public function clear()
    {
        $this->reset('searchText', 'start_date', 'end_date' , 'status');
    }

    public function updated()
    {
        $this->resetPage();
    }

    public $pageName = 'opportunities';
    public function render()
    {
        $query = Opportunity::query();

        if ( !empty($this->searchText) ) {
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


        return view('livewire.opportunity.index' ,
            [
                'opportunities' => $query->latest()->with('organization')->paginate(12),
            ]
        );
    }
}

