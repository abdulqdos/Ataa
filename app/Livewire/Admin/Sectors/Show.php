<?php

namespace App\Livewire\Admin\Sectors;

use App\Livewire\AdminComponent;
use App\Models\Sector;
use Livewire\Attributes\Title;
use Livewire\WithPagination;


#[Title('عرض تفاصيل القطاع')]
class Show extends AdminComponent
{
    use withPagination ;
    public $sector , $activeTab = 'organizations';

    public function setActiveTab($value)
    {
        $this->activeTab = $value ;
    }
    public function mount(Sector $sector)
    {
        $this->sector = $sector;
    }

    public function render()
    {
        return view('livewire.admin.sectors.show' , [
            'sector' => $this->sector,
            'organizations' =>  $this->sector->organizations()->paginate(10),
            'opportunities' =>  $this->sector->opportunities()->paginate(10),
        ]);
    }
}
