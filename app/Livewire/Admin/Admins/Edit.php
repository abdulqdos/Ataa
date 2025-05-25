<?php

namespace App\Livewire\Admin\Admins;

use App\Livewire\AdminComponent;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('تعديل المشرف')]
class Edit extends AdminComponent
{
    public $user_name , $email , $userId , $admin;

    protected function rules()
    {
        return [
            'user_name' => 'required|min:3|max:50|regex:/^(?!_)[a-zA-Z0-9_]+(?<!_)$/',
            'email' => 'required|email|unique:users,email,' . $this->userId,
        ];
    }

    protected $messages = [
        'user_name.required' => 'اسم المستخدم مطلوب.',
        'user_name.min' => 'اسم المستخدم يجب أن يكون على الأقل 3 أحرف.',
        'user_name.max' => 'اسم المستخدم يجب ألا يزيد عن 8 أحرف.',
        'user_name.regex' => 'اسم المستخدم يجب أن يحتوي فقط على أحرف وأرقام ويمكن أن يتضمن شرطة سفلية (_) بشرط ألا تبدأ أو تنتهي بها.',

        'email.required' => 'البريد الإلكتروني مطلوب.',
        'email.email' => 'صيغة البريد الإلكتروني غير صحيحة.',
        'email.unique' => 'هذا البريد الإلكتروني مستخدم من قبل.',
    ];

    public function mount(User $admin)
    {
        if($admin->role != 'admin')
        {
            abort(403);
        }

        $this->user_name = $admin->user_name;
        $this->email = $admin->email;
        $this->userId = $admin->id ;
        $this->admin = $admin ;
    }

    public function update()
    {
        $this->validate();
        $this->admin->update([
           'user_name' =>  $this->user_name,
            'email' => $this->email
        ]);
        session()->flash('success' , 'تم تعديل مشرف بنجاح .');
        return $this->redirect(route('admin.admins') , true);
    }
    public function render()
    {
        return view('livewire.admin.admins.edit');
    }
}
