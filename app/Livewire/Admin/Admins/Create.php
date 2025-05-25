<?php

namespace App\Livewire\Admin\Admins;

use App\Livewire\AdminComponent;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Title;

#[Title('إضافة مشرف')]
class Create extends AdminComponent
{
    public $user_name , $email ;

    protected $rules = [
        'user_name' => 'required|min:3|max:50|regex:/^(?!_)[a-zA-Z0-9_]+(?<!_)$/',
        'email' => 'required|email|unique:users',
    ];
    protected $messages = [
        'user_name.required' => 'اسم المستخدم مطلوب.',
        'user_name.min' => 'اسم المستخدم يجب أن يكون على الأقل 3 أحرف.',
        'user_name.max' => 'اسم المستخدم يجب ألا يزيد عن 8 أحرف.',
        'user_name.regex' => 'اسم المستخدم يجب أن يحتوي فقط على أحرف وأرقام ويمكن أن يتضمن شرطة سفلية (_) بشرط ألا تبدأ أو تنتهي بها.',

        'email.required' => 'البريد الإلكتروني مطلوب.',
        'email.email' => 'صيغة البريد الإلكتروني غير صحيحة.',
        'email.unique' => 'هذا البريد الإلكتروني مستخدم من قبل.',
    ];

    public function mount()
    {
        Gate::authorize('view-any', User::class);
    }
    public function store()
    {
        $this->validate();
        User::create([
            'user_name' => $this->user_name,
            'email' => $this->email,
            'password' => bcrypt(00000000),
            'role' => 'admin'
        ]);
        session()->flash('success' , 'تم إضافة مشرف بنجاح .');
        return $this->redirect(route('admin.admins') , true);
    }

    public function render()
    {
        return view('livewire.admin.admins.create');
    }
}
