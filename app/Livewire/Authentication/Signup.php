<?php

namespace App\Livewire\Authentication;

use App\Livewire\Forms\organizationRegisterForm;
use App\Livewire\Forms\VolunteerRegisterForm;
use App\Models\User;
use App\Models\Volunteer;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Signup extends Component
{
    #[title('إنشاء حساب')]

    // Validation rules for each field
    #[Validate('required|string|regex:/^[a-zA-Z]+$/u|min:4|max:20')]
    public $user_name;

    #[Validate('required|email|unique:users')]
    public $email;

    #[Validate('required|min:8|max:20|confirmed')]
    public $password;

    #[Validate('required|min:8|max:20')]
    public $password_confirmation;

    #[Validate('required')]
    public $userType;


    // Volunteer Fields
    #[validate('required|string|min:2|max:50')]
    public $first_name ;
    #[validate('required|string|min:2|max:50')]
    public $last_name ;
    #[validate('required|in:male,female')]
    public $gender ;
    #[validate('required|string|max:100')]
    public $education_level ;

    #[validate('integer')]
    public $age ;

    // Error messages for validation
    protected $messages = [
        'user_name.required' => 'اسم المستخدم مطلوب.',
        'user_name.string' => 'يجب أن يكون اسم المستخدم نصًا.',
        'user_name.regex' => 'يجب أن يحتوي اسم المستخدم على حروف فقط بدون أرقام أو رموز.',
        'user_name.min' => 'يجب أن يكون اسم المستخدم على الأقل 4 أحرف.',
        'user_name.max' => 'يجب ألا يزيد اسم المستخدم عن 20 حرفًا.',

        'email.required' => 'البريد الإلكتروني مطلوب.',
        'email.email' => 'يجب إدخال بريد إلكتروني صالح.',

        'password.required' => 'كلمة المرور مطلوبة.',
        'password.min' => 'يجب أن تكون كلمة المرور على الأقل 8 أحرف.',
        'password.max' => 'يجب ألا تزيد كلمة المرور عن 20 حرفًا.',
        'password.confirmed' => 'كلمة المرور والتأكيد غير متطابقتين.',

        'password_confirmation.required' => 'تأكيد كلمة المرور مطلوب.',
        'password_confirmation.min' => 'يجب أن يكون تأكيد كلمة المرور على الأقل 8 أحرف.',
        'password_confirmation.max' => 'يجب ألا يزيد تأكيد كلمة المرور عن 20 حرفًا.',

        'userType.required' => 'نوع الحساب مطلوب .',

        // messages Volunteer fields
        'first_name.required' => 'الاسم الأول مطلوب.',
        'first_name.string' => 'الاسم الأول يجب أن يكون نصًا.',
        'first_name.min' => 'الاسم الأول يجب أن يكون على الأقل حرفين.',
        'first_name.max' => 'الاسم الأول يجب ألا يتجاوز 50 حرفًا.',

        'last_name.required' => 'الاسم الأخير مطلوب.',
        'last_name.string' => 'الاسم الأخير يجب أن يكون نصًا.',
        'last_name.min' => 'الاسم الأخير يجب أن يكون على الأقل حرفين.',
        'last_name.max' => 'الاسم الأخير يجب ألا يتجاوز 50 حرفًا.',

        'gender.required' => 'الجنس مطلوب.',
        'gender.in' => 'يجب أن يكون الجنس إما ذكر (male) أو أنثى (female).',

        'education_level.required' => 'المستوى الدراسي مطلوب.',
        'education_level.string' => 'المستوى الدراسي يجب أن يكون نصًا.',
        'education_level.max' => 'المستوى الدراسي يجب ألا يتجاوز 100 حرف.',

        'age.integer' => 'العمر يجب أن يكون رقمًا صحيحًا.',
    ];



    // Handle registration based on userType
    public function register()
    {
        // Validate the form before submitting
        if ($this->userType === 'volunteer') {

            $this->validate();

            // create volunteer
            $volunteer = Volunteer::create([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'gender' => $this->gender,
                'education_level' => $this->education_level,
                'age' => $this->age,
            ]);

            $user = User::create([
                'user_name' => $this->user_name,
                'email' => $this->email,
                'password' => bcrypt($this->password),
            ]);

            $user->userable()->associate($volunteer);
            $user->userable_type = 'Volunteer';
            $user->save();


        } elseif ($this->userType === 'organization') {
            $this->organizationRegisterForm->register();
        }

        Auth::login($user);
        session()->flash('success', 'تم إنشى حسابك بنجاح (: اتمنى لك رحلة تطوعية مليئة بالعطاء');
        $this->redirectRoute( 'home' , navigate: true);
    }

    public function render()
    {
        return view('livewire.authentication.signup');
    }
}
