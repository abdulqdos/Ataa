<?php

namespace App\Livewire\Admin\Sectors;

use App\Livewire\AdminComponent;
use App\Models\Sector;


class Create extends AdminComponent
{
    public $name ;

    protected $rules = [
        'name' => 'required|min:3|max:50|string|regex:/^[\pL\s\-]+$/u|unique:sectors,name',

    ];

    protected $messages = [
        'name.required' => 'حقل الاسم مطلوب .',
        'name.min' => 'أقل عدد لخروف 3 .',
        'name.max' => 'اكبر عدد لخروف 50 .',
        'name.string' => 'يحب أن يكون الاسم حروف .',
        'name.regex' => 'يحب أن يكون الاسم حروف .',
        'name.unique' => 'هذا القطاع موجود من قبل.',
    ];

    public function store()
    {
        $this->validate();
        Sector::create([
            'name' => $this->name
        ]);
        session()->flash('success' , 'تم إضافة القطاع بنجاح .');
        return $this->redirect(route('admin.sectors') , true);
    }
    public function render()
    {
        return view('livewire.admin.sectors.create');
    }
}
