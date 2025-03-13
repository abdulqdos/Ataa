<?php

namespace App\Livewire\Authentication;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Login extends Component
{

    #[Title('تسجيل دخول')]

    #[validate('required|email')]
    public $email;

    #[validate('required|min:8|max:20')]
    public $password;

    protected $messages = [
        'email.required' => 'البريد الإلكتروني مطلوب.',
        'email.email' => 'الرجاء إدخال بريد إلكتروني صالح.',
        'password.required' => 'كلمة المرور مطلوبة.',
        'password.min' => 'يجب أن تكون كلمة المرور على الأقل 8 أحرف.',
        'password.max' => 'يجب ألا تزيد كلمة المرور عن 20 حرفًا.',
    ];
    public function authenticate()
    {
        $this->validate();
        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            throw ValidationException::withMessages([
                'password' => ['كلمة المرور أو الايميل غير صحيح .'],
            ]);
        }

        $user = Auth::user();

        Auth::login($user);

        $this->redirect('/');
    }
    public function render()
    {
        return view('livewire.authentication.login');
    }
}
