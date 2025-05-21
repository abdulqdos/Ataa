<?php

namespace App\Livewire\Admin\Sectors;

use App\Livewire\AdminComponent;
use App\Models\Sector;
use Livewire\Attributes\Title;


#[Title('عرض تفاصيل القطاع')]
class Show extends AdminComponent
{
    public $sector ;

    public function mount(Sector $sector)
    {
        $this->sector = $sector;
    }

    public function render()
    {
        return view('livewire.admin.sectors.show' , [
            'sector' => $this->sector
        ]);
    }
}
