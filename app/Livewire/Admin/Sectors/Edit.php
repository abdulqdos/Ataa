<?php

namespace App\Livewire\Admin\Sectors;

use App\Livewire\AdminComponent;
use App\Models\Sector;
use Livewire\Attributes\Title;

#[Title('تعديل قطاع')]
class Edit extends AdminComponent
{
    public $sector , $name ;

    protected $rules = [
        'name' => 'required|min:3|max:50|string|regex:/^[\pL\s\-]+$/u|unique:sectors,name',
        'name.unique' => 'هذا الاسم مستخدم من قبل، الرجاء اختيار اسم آخر.',
    ];
    protected $messages = [
        'name.required' => 'حقل الاسم مطلوب .',
        'name.min' => 'أقل عدد لخروف 3 .',
        'name.max' => 'اكبر عدد لخروف 50 .',
        'name.string' => 'يحب أن يكون الاسم حروف .',
        'name.regex' => 'يحب أن يكون الاسم حروف .',
        'name.unique' => 'هذا القطاع موجود من قبل.',
    ];

    public function mount(Sector $sector)
    {
        $this->name  = $sector->name;
        $this->sector = $sector;
    }

    public function update()
    {
        $this->validate();
        $this->sector->update($this->all());
        session()->flash('success' , 'تم تعديل القطاع بنجاح .');
        return $this->redirect(route('admin.sectors') , true);
    }
    public function render()
    {
        return view('livewire.admin.sectors.edit' , [
            'sector' => $this->sector,
        ]);
    }
}


