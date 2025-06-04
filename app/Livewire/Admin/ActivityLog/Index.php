<?php

namespace App\Livewire\Admin\ActivityLog;

use App\Livewire\AdminComponent;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Activitylog\Models\Activity;

class Index extends AdminComponent
{
    use withPagination;
    public function render()
    {
        return view('livewire.admin.activity-log.index' , [
            'activities' =>  Activity::latest()->paginate(10),
        ]);
    }
}
