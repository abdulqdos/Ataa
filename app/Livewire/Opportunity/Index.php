<?php

namespace App\Livewire\Opportunity;

use App\Models\Opportunity;
use App\Models\Sector;
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
    public $start_date, $end_date, $status , $with_certificate , $sector;
    public $header ;
    public $pageName = 'opportunities';

    public function mount($header = 'none')
    {
        $this->header = 'كل الفرص';
    }

    #[On('search:clear')]
    public function clear()
    {
        $this->reset('searchText', 'start_date', 'end_date' , 'status' , 'with_certificate' , 'sector');
    }

    public function updated()
    {
        $this->resetPage();
    }

    public function getOpportunities()
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

        if (!empty($this->with_certificate || $this->with_certificate === '0' )){
            $query->where('has_certificate' , $this->with_certificate);
        }

        if(!empty($this->sector)) {
            $query->where('sector_id' , $this->sector);
        }

        return $query ;
    }
    public function render()
    {
        $query = $this->getOpportunities();

        return view('livewire.opportunity.index' ,
            [
                'opportunities' => $query->latest()->with('organization')->paginate(12),
                'sectors' => Sector::all(),
            ]
        );
    }
}

