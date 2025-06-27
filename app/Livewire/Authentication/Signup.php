<?php

namespace App\Livewire\Authentication;

use App\Models\City;
use App\Models\Organization;
use App\Models\Sector;
use App\Models\User;
use App\Models\Volunteer;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

class Signup extends Component
{
    #[title('إنشاء حساب')]

    // Validation rules for common fields
    protected $commonRules = [
        'user_name' => 'required|string|regex:/^[a-zA-Z]+$/u|min:4|max:20|alpha_dash|unique:users,user_name',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8|max:20|confirmed',
    ];



    // Volunteer Fields
    protected $volunteerRules = [
        'first_name' => 'required|string|min:2|regex:/^[\p{Arabic}a-zA-Z]+$/u|max:50',
        'last_name' => 'required|string|min:2|regex:/^[\p{Arabic}a-zA-Z]+$/u|max:50',
        'gender' => 'required|in:male,female',
        'phone_number' => 'required|regex:/^[0-9]+$/',
        'age' => 'integer|min:8|max:90',
    ];

    // Organization Fields
    protected $organizationRules = [
        'name' => 'required|string|min:2|max:50',
        'city' => 'required',
        'sector' => 'required',
        'contact_email' => 'required|email|unique:organizations',
        'phone_number_organization' => 'required|regex:/^[0-9]+$/',
    ];

    // Define variables
    public $userType = "volunteer";
    public $user_name, $email, $password, $password_confirmation ;
    public $first_name, $last_name, $gender, $phone_number, $age;
    public $name, $city , $sector , $contact_email , $phone_number_organization ;

    // Error messages for validation
    protected $messages = [
        'user_name.required' => 'اسم المستخدم مطلوب.',
        'user_name.string' => 'يجب أن يكون اسم المستخدم نصًا.',
        'user_name.regex' => 'يجب أن يحتوي اسم المستخدم على حروف إنجليزية فقط.',
        'user_name.min' => 'يجب أن يكون اسم المستخدم على الأقل 4 أحرف.',
        'user_name.max' => 'يجب ألا يزيد اسم المستخدم عن 20 حرفًا.',
        'user_name.alpha_dash' => 'اسم المستخدم يمكن أن يحتوي على أحرف، أرقام، شرطات (-) أو (_) فقط.',
        'user_name.unique' => 'اسم المستخدم هذا مستخدم بالفعل.',
        'email.required' => 'البريد الإلكتروني مطلوب.',
        'email.email' => 'يرجى إدخال بريد إلكتروني صالح.',
        'email.unique' => 'البريد الإلكتروني مسجل مسبقًا.',

        'password.required' => 'كلمة المرور مطلوبة.',
        'password.min' => 'يجب أن تتكون كلمة المرور من 8 أحرف على الأقل.',
        'password.max' => 'يجب ألا تزيد كلمة المرور عن 20 حرفًا.',
        'password.confirmed' => 'تأكيد كلمة المرور غير متطابق.',

        'first_name.required' => 'الاسم الأول مطلوب.',
        'first_name.string' => 'يجب أن يكون الاسم الأول نصًا.',
        'first_name.min' => 'يجب أن يتكون الاسم الأول من حرفين على الأقل.',
        'first_name.max' => 'يجب ألا يزيد الاسم الأول عن 50 حرفًا.',
        'first_name.regx' => 'يجب ان يكون اسم الاول يحتوي على حرف فقط.',

        'last_name.required' => 'الاسم الأخير مطلوب.',
        'last_name.string' => 'يجب أن يكون الاسم الأخير نصًا.',
        'last_name.min' => 'يجب أن يتكون الاسم الأخير من حرفين على الأقل.',
        'last_name.max' => 'يجب ألا يزيد الاسم الأخير عن 50 حرفًا.',
        'last_name.regx' => 'يجب ان يكون اسم الاول يحتوي على حرف فقط.',

        'gender.required' => 'الجنس مطلوب.',
        'gender.in' => 'يجب اختيار الجنس بين ذكر أو أنثى.',

        'age.required' => 'العمر مطلوب.',
        'age.integer' => 'يجب أن يكون العمر رقمًا صحيحًا.',
        'age.min' => 'يجب أن يكون العمر اكبر من 7.',
        'age.max' => 'يجب أن يكون العمر اصغر من 91.',

        'phone_number.required' => 'العمر مطلوب.',
        'phone_number.regx' => 'يجب أن يكون  رقمًا صحيحًا.',
        'phone_number.digits' => 'يجب أن يكون  عدد  خانات 10 .',

        'name.required' => 'اسم المؤسسة مطلوب.',
        'name.string' => 'يجب أن يكون اسم المؤسسة نصًا.',
        'name.min' => 'يجب أن يتكون اسم المؤسسة من حرفين على الأقل.',
        'name.max' => 'يجب ألا يزيد اسم المؤسسة عن 50 حرفًا.',

        'phone_number_organization.required' => 'رقم مطلوب.',
        'phone_number_organization.regx' => 'يجب أن يكون  رقمًا صحيحًا.',
        'phone_number_organization.digits' => 'يجب أن يكون  عدد  خانات 10 .',

        'contact_email.required' => 'البريد الإلكتروني مطلوب.',
        'contact_email.email' => 'يرجى إدخال بريد إلكتروني صالح.',
        'contact_email.unique' => 'البريد الإلكتروني مسجل مسبقًا.',

        'city.required' => 'يجب اختيار المدينة.',
        'sector.required' => 'يجب اختيار القطاع.',
    ];

    // Handle registration based on userType
    public function register()
    {
        // Apply common validation
        $this->validate(array_merge($this->commonRules, $this->userType === 'volunteer' ? $this->volunteerRules : $this->organizationRules));

        if ($this->userType === 'volunteer') {
            $this->signupVolunteer();
            session()->flash('success', 'تم إنشى حسابك بنجاح (: اتمنى لك رحلة تطوعية مليئة بالعطاء');
            $this->redirectRoute('home', navigate: true);
        } elseif ($this->userType === 'organization') {
           $this->signinOrganization();
            session()->flash('success', 'تم إنشى حسابك بنجاح (: اتمنى لك رحلة تطوعية مليئة بالعطاء');
            $this->redirectRoute('organization.dashboard', navigate: true);
        }

    }

    public function signupVolunteer()
    {
        // Create a user
        $user = User::create([
            'user_name' => $this->user_name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'role' => 'volunteer',
        ]);

        // Create volunteer and associate with user
        Volunteer::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'gender' => $this->gender,
            'phone_number' => $this->phone_number,
            'age' => $this->age,
            'user_id' => $user->id,
        ]);

        // Log in the user and redirect
        Auth::login($user);
    }

    public function signinOrganization()
    {
        // Create organization and associate with user
        $user = User::create([
            'user_name' => $this->user_name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'role' => 'organization',
        ]);

        Organization::create([
            'name' => $this->name,
            'city_id' => $this->city,
            'sector_id' => $this->sector,
            'contact_email' => $this->contact_email,
            'phone_number' => $this->phone_number_organization,
            'user_id' => $user->id,
        ]);

        // Log in the user and redirect
        Auth::login($user);
    }
    public function render()
    {
        return view('livewire.authentication.signup', [
            'cities' => City::all(),
            'sectors' => Sector::all(),
        ]);
    }
}
