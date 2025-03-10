<?php
namespace App\Livewire\Authentication ;

use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class ResetPassword extends Component
{
    #[title('كلمة السر االجديدة')]
    public $email;
    public $token;
    public $password;
    public $password_confirmation;

    public function mount($token)
    {
        $this->token = $token;
    }

    public function resetPassword()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            [
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
                'token' => $this->token,
            ],
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            session()->flash('success', 'تم تغيير كلمة المرور بنجاح.');
            return redirect()->route('login');
        } else {
            session()->flash('error', 'رمز إعادة التعيين غير صالح أو انتهت صلاحيته.');
        }
    }

    public function render()
    {
        return view('livewire.authentication.reset-password');
    }
}
