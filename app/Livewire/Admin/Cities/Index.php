<?php

namespace App\Livewire\Admin\Cities;

use App\Livewire\AdminComponent;
use App\Models\City;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

#[Title('المدن')]
class Index extends AdminComponent
{
    use withPagination ;
    #[Url(as: 'q', except: '')]
    public $searchText ;

    public function clear()
    {
        $this->searchText = '';
    }

    public function updated()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = City::query();

        if(!empty($this->searchText))
        {
            $query->where('name', 'like', '%' . $this->searchText . '%');
        }

        return view('livewire.admin.cities.index' , [
            'cities' => $query->latest()->paginate(10),
        ]);
    }
}
