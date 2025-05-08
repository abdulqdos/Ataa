<?php

namespace App\Livewire\Volunteers;

use App\Models\Volunteer;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('المتطوعون - عطاء')]
class Index extends Component
{
    use WithPagination;
    #[Url(as: 'q', except: '')]
    public $searchText;


    #[On('search:clear')]
    public function clear()
    {
        $this->reset('searchText');
    }

    public function updated()
    {
        $this->resetPage();
    }
    public function getVolunteers()
    {
        $query = Volunteer::query();

        // Some Search Block
        if(!empty($this->searchText))
        {
            $query->where('first_name', 'like', '%' . $this->searchText . '%')->orWhere('last_name', 'like', '%' . $this->searchText . '%');
        }
        return $query;
    }

    public function render()
    {
        $query = $this->getVolunteers();
        return view('livewire.volunteers.index' , [
            'volunteers' => $query->paginate(9),
        ]);
    }
}
