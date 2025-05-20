<?php

namespace App\Livewire\Admin\Sectors;

use App\Livewire\AdminComponent;
use App\Models\Sector;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

#[Title('إدارة القطاعات')]
class Index extends AdminComponent
{
    use withPagination;
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
        $query = Sector::query();

        if(!empty($this->searchText))
        {
            $query->where('name', 'like', '%' . $this->searchText . '%');
        }
        return view('livewire.admin.sectors.index' , [
            'sectors' => $query->paginate(10),
        ]);
    }
}
