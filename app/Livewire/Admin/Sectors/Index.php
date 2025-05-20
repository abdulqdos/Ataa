<?php

namespace App\Livewire\Admin\Sectors;

use App\Livewire\AdminComponent;
use App\Models\Sector;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Title('إدارة القطاعات')]
class Index extends AdminComponent
{
    use withPagination;
    public function render()
    {
        return view('livewire.admin.sectors.index' , [
            'sectors' => Sector::paginate(10),
        ]);
    }
}
