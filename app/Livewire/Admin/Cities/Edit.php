<?php

namespace App\Livewire\Admin\Cities;

use App\Livewire\AdminComponent;
use App\Models\City;
use Livewire\Attributes\Title;


#[Title('تعديل المدينة')]
class Edit extends AdminComponent
{
    public  $city  , $name ;
    protected $rules = [
        'name' => 'required|min:3|max:50|string|regex:/^[\pL\s\-]+$/u|unique:cities,name',
    ];
    protected $messages = [
        'name.required' => 'حقل الاسم مطلوب .',
        'name.min' => 'أقل عدد لخروف 3 .',
        'name.max' => 'اكبر عدد لخروف 50 .',
        'name.string' => 'يحب أن يكون الاسم حروف .',
        'name.regex' => 'يحب أن يكون الاسم حروف .',
        'name.unique' => 'هذا المدينة موجود من قبل.',
    ];

    public function mount(City $city)
    {
        $this->name = $city->name ;
        $this->city = $city;
    }

    public function update()
    {
        $this->validate();
        $this->city->update([
            'name' => $this->name
        ]);
        session()->flash('success' , 'تم تعديل المدينة بنجاح .');
        return $this->redirect(route('admin.cities') ,  true);
    }
    public function render()
    {
        return view('livewire.admin.cities.edit');
    }
}
