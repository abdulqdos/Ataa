<?php

namespace App\Livewire\Authentication;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use Livewire\Attributes\Title;

class ForgotPassword extends Component
{
    #[title('إستعادة كلمة السر')]
    public $email;
    public function sendResetLink()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $this->email)->first();

        if ($user) {
            $token = Password::createToken($user);
            $resetUrl = route('password.reset', ['token' => $token, 'email' => $this->email]);

            Mail::to($this->email)->send(new ResetPasswordMail($resetUrl));

            session()->flash('message', 'تحقق من البريد الالكتروني');
        } else {
            session()->flash('error', 'حدث خطأ أثناء إرسال البريد.');
        }
    }

    public function render()
    {
        return view('livewire.authentication.forgot-password');
    }
}
