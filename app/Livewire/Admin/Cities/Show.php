<?php

namespace App\Livewire\Admin\Cities;

use App\Livewire\AdminComponent;
use App\Models\City;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('عرض المدينة ')]
class Show extends AdminComponent
{
    public $city  ;

    public function mount(City $city)
    {
        $this->city = $city ;
    }

    public function render()
    {
        return view('livewire.admin.cities.show' , [
            'city' => $this->city,
            'organizations' => $this->city->organizations()->latest()->paginate(9),
        ]);
    }
}
