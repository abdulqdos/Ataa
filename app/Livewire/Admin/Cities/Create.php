<?php

namespace App\Livewire\Admin\Cities;

use App\Livewire\AdminComponent;
use App\Models\City;
use Livewire\Attributes\Title;

#[Title('إضافة مدينة')]
class Create extends AdminComponent
{
    public $name ;
    protected $rules = [
        'name' => 'required|min:3|max:50|string|regex:/^[\pL\s\-]+$/u',
    ];
    protected $messages = [
        'name.required' => 'حقل الاسم مطلوب .',
        'name.min' => 'أقل عدد لخروف 3 .',
        'name.max' => 'اكبر عدد لخروف 50 .',
        'name.string' => 'يحب أن يكون الاسم حروف .',
        'name.regex' => 'يحب أن يكون الاسم حروف .',
    ];

    public function store()
    {
        $this->validate();
        City::create([
            'name' => $this->name,
        ]);
        session()->flash('success' , 'تم إضافة المدينة بنجاح .');
        return $this->redirect(route('admin.cities') ,  true);
    }
    public function render()
    {
        return view('livewire.admin.cities.create');
    }
}
