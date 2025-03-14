<?php

namespace App\Livewire\Authentication;

use App\Livewire\Forms\Organization\organizationRegisterForm;
use App\Livewire\Forms\Voulnteer\volunteerRegisterForm;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Signup extends Component
{
    #[title('إنشاء حساب')]

    #[Validate('required|string|regex:/^[a-zA-Z]+$/u|min:4|max:20')]
    public $user_name ;

    #[Validate('required|email')]
    public $email ;

    #[Validate('required|min:8|max:20|confirmed')]
    public $password;

    #[Validate('required|min:8|max:20')]
    public $password_confirmation;

    #[Validate('required')]
    public $userType ;

    public ?volunteerRegisterForm $volunteerRegisterForm = null;
    public ?organizationRegisterForm $organizationRegisterForm = null;

    // Error messages
    protected $messages = [

        // Validation message user name
        'user_name.required' => 'اسم المستخدم مطلوب.',
        'user_name.string' => 'يجب أن يكون اسم المستخدم نصًا.',
        'user_name.regex' => 'يجب أن يحتوي اسم المستخدم على حروف فقط بدون أرقام أو رموز.',
        'user_name.min' => 'يجب أن يكون اسم المستخدم على الأقل 4 أحرف.',
        'user_name.max' => 'يجب ألا يزيد اسم المستخدم عن 20 حرفًا.',

        // Validation message email
        'email.required' => 'البريد الإلكتروني مطلوب.',
        'email.email' => 'يجب إدخال بريد إلكتروني صالح.',

        // Validation message Password
        'password.required' => 'كلمة المرور مطلوبة.',
        'password.min' => 'يجب أن تكون كلمة المرور على الأقل 8 أحرف.',
        'password.max' => 'يجب ألا تزيد كلمة المرور عن 20 حرفًا.',
        'password.confirmed' => 'كلمة المرور والتأكيد غير متطابقتين.',

        // Validation message Password Confirmation
        'password_confirmation.required' => 'تأكيد كلمة المرور مطلوب.',
        'password_confirmation.min' => 'يجب أن يكون تأكيد كلمة المرور على الأقل 8 أحرف.',
        'password_confirmation.max' => 'يجب ألا يزيد تأكيد كلمة المرور عن 20 حرفًا.',
    ];

    public function register()
    {
        $this->validate();

        if($this->account_type == 'volunteer'){
            $this->volunteerRegisterForm->register() ;
        } else {
            $this->organizationRegisterForm->register() ;
        }

    }
    public function render()
    {
        return view('livewire.authentication.signup');
    }
}
