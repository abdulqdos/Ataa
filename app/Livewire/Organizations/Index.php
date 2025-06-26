<?php

namespace App\Livewire\Organizations;

use App\Models\City;
use App\Models\Organization;
use App\Models\Sector;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('المؤسسات')]
class Index extends Component
{
    use withPagination ;
    #[Url(as: 'q', except: '')]
    public $searchText , $selectedSector;
    #[On('search:clear')]
    public function clear()
    {
        $this->reset('searchText');
    }

    public function updated()
    {
        $this->resetPage();
    }

    public function getOrganizations()
    {
        $query = Organization::query();

        if(!empty($this->searchText))
        {
            $query->where('name', 'like', '%' . $this->searchText . '%');
        }

        if(!empty($this->selectedSector)) {
            $query->where('sector_id', $this->selectedSector);
        }

        return $query ;
    }
    public function render()
    {
        $query = $this->getOrganizations();
        return view('livewire.organizations.index' , [
            'organizations' => $query->paginate(9),
            'sectors' => Sector::all(),
            'cities' => City::all(),
        ]);
    }
}
