<?php
namespace App\Livewire\Authentication ;

use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
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
    #[Validate('required|min:8|max:20|confirmed')]
    public $password;

    #[Validate('required|min:8|max:20')]
    public $password_confirmation;

    protected $messages = [
        'password.required' => 'كلمة المرور مطلوبة.',
        'password.min' => 'يجب أن تكون كلمة المرور على الأقل 8 أحرف.',
        'password.max' => 'يجب ألا تزيد كلمة المرور عن 20 حرفًا.',
        'password.confirmed' => 'كلمة المرور والتأكيد غير متطابقتين.',

        'password_confirmation.required' => 'تأكيد كلمة المرور مطلوب.',
        'password_confirmation.min' => 'يجب أن يكون تأكيد كلمة المرور على الأقل 8 أحرف.',
        'password_confirmation.max' => 'يجب ألا يزيد تأكيد كلمة المرور عن 20 حرفًا.',
    ];

    public function mount($token,$email)
    {
        $this->email = $email;
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
