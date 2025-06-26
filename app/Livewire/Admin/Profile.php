<?php

namespace App\Livewire\Admin;

use App\Livewire\AdminComponent;
use App\Models\Volunteer;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Title;

#[Title('ملف شخصي')]
class Profile extends AdminComponent
{
    public $user ;
    public $old_password , $new_password , $new_password_confirmation;

    public function mount()
    {
        $this->user = auth()->user();
    }
    public function changePassword()
    {
        $this->validate(
            [
                'old_password' => 'required|current_password',
                'new_password' => 'required|string|min:8|confirmed',
            ],
            [
                'old_password.required' => 'يجب إدخال كلمة المرور القديمة.',
                'old_password.current_password' => 'كلمة المرور القديمة غير صحيحة.',
                'new_password.required' => 'يجب إدخال كلمة المرور الجديدة.',
                'new_password.min' => 'كلمة المرور الجديدة يجب أن تكون على الأقل 8 أحرف.',
                'new_password.confirmed' => 'تأكيد كلمة المرور الجديدة غير متطابق.',
            ],
            [
                'old_password' => 'كلمة المرور القديمة',
                'new_password' => 'كلمة المرور الجديدة',
            ]
        );

        $this->user->password = bcrypt($this->new_password);

        $this->user->save();

        session()->flash('success', 'تم تغيير كلمة المرور بنجاح.');

        $this->reset(['old_password', 'new_password', 'new_password_confirmation']);

        return redirect(route('admin.dashboard' ));
    }


    public function render()
    {
        return view('livewire.admin.profile');
    }
}
