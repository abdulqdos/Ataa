<?php

namespace App\Livewire\Volunteer\Profile ;

use App\Models\Volunteer;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use withFileUploads ;
    #[title('تعديل ملف الشخصي')]
    public $user , $user_name , $first_name , $last_name  ,  $email , $phone_number ,$gender, $age , $bio ,$img , $img_url ;

    public $old_password , $new_password , $new_password_confirmation;

    // rules
    protected function rules()
    {
        return [
            'first_name' => 'required|string|min:2|regex:/^[a-zA-Zء-ي]+$/u|max:50',
            'last_name' => 'required|string|min:2|regex:/^[a-zA-Zء-ي]+$/u|max:50',
            'gender' => 'required|in:male,female',
            'phone_number' => 'required|digits_between:8,15',
            'age' => 'required|integer|min:8|max:90',
            'user_name' => 'required|string|min:3|max:30|alpha_dash|unique:users,user_name,' . $this->user->id,
            'bio' => 'nullable|string|min:10|max:300',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|email|max:255|unique:users,email,' . $this->user->id,
            'old_password' => ['nullable'],
            'new_password' => ['nullable'],
        ];
    }
    protected $messages = [
        // first_name
        'first_name.required' => 'الاسم الأول مطلوب.',
        'first_name.string' => 'الاسم الأول يجب أن يكون نصاً.',
        'first_name.min' => 'الاسم الأول يجب ألا يقل عن 2 أحرف.',
        'first_name.max' => 'الاسم الأول يجب ألا يزيد عن 50 حرفاً.',
        'first_name.regex' => 'الاسم الأول يجب أن يحتوي على حروف فقط.',

        // last_name
        'last_name.required' => 'الاسم الأخير مطلوب.',
        'last_name.string' => 'الاسم الأخير يجب أن يكون نصاً.',
        'last_name.min' => 'الاسم الأخير يجب ألا يقل عن 2 أحرف.',
        'last_name.max' => 'الاسم الأخير يجب ألا يزيد عن 50 حرفاً.',
        'last_name.regex' => 'الاسم الأخير يجب أن يحتوي على حروف فقط.',

        // gender
        'gender.required' => 'الجنس مطلوب.',
        'gender.in' => 'يجب اختيار الجنس من بين "ذكر" أو "أنثى".',

        // phone_number
        'phone_number.required' => 'رقم الهاتف مطلوب.',
        'phone_number.digits_between' => 'رقم الهاتف يجب أن رقمأ حقيقي.',
        'phone_number.integer' => 'رقم الهاتف يجب أن يكون أرقاماً فقط.',

        // age
        'age.required' => 'العمر مطلوب.',
        'age.integer' => 'العمر يجب أن يكون رقماً.',
        'age.min' => 'العمر يجب ألا يقل عن 8 سنوات.',
        'age.max' => 'العمر يجب ألا يزيد عن 90 سنة.',

        // username
        'user_name.required' => 'اسم المستخدم مطلوب.',
        'user_name.string' => 'اسم المستخدم يجب أن يكون نصاً.',
        'user_name.min' => 'اسم المستخدم يجب ألا يقل عن 3 أحرف.',
        'user_name.max' => 'اسم المستخدم يجب ألا يزيد عن 30 حرفاً.',
        'user_name.alpha_dash' => 'اسم المستخدم يمكن أن يحتوي على أحرف، أرقام، شرطات (-) أو (_) فقط.',
        'user_name.unique' => 'اسم المستخدم هذا مستخدم بالفعل.',

        // email
        'email.required' => 'البريد الإلكتروني مطلوب.',
        'email.email' => 'صيغة البريد الإلكتروني غير صحيحة.',
        'email.max' => 'البريد الإلكتروني يجب ألا يزيد عن 255 حرفاً.',
        'email.unique' => 'هذا البريد الإلكتروني مستخدم بالفعل.',

        // bio
        'bio.string' => 'الوصف التعريفي يجب أن يكون نصاً.',
        'bio.min' => 'الوصف التعريفي يجب ألا يقل عن 10 أحرف.',
        'bio.max' => 'الوصف التعريفي يجب ألا يزيد عن 300 حرف.',

        // images
        'img.required' => 'يرجى رفع صورة.',
        'img.image' => 'الملف المرفوع يجب أن يكون صورة.',
        'img.mimes' => 'صيغة الصورة يجب أن تكون من نوع: jpeg, png, jpg, gif.',
        'img.max' => 'حجم الصورة يجب ألا يتجاوز 2 ميغابايت.',
    ];

    public function mount(Volunteer $volunteer)
    {
        Gate::authorize('update', $volunteer);

        $this->user = auth()->user();
        $this->user_name = $this->user->user_name;
        $this->email = $this->user->email;
        $this->first_name = $this->user->volunteer->first_name ;
        $this->last_name = $this->user->volunteer->last_name ;
        $this->phone_number = $this->user->volunteer->phone_number ;
        $this->gender = $this->user->volunteer->gender ;
        $this->age = $this->user->volunteer->age ;
        $this->bio = $this->user->volunteer->bio ;
        $this->img_url =  $this->user->img_url ;
    }

    public function update()
    {
        $this->validate();

        if($this->img) {
            $this->img_url = $this->img->storePublicly('img_photos' , ['disk' => 'public']);
        }

        $this->user->update([
            'user_name' => $this->user_name,
            'email' => $this->email,
            'img_url' => $this->img_url,

        ]);

        $this->user->volunteer->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone_number' => $this->phone_number,
            'gender' => $this->gender,
            'age' => $this->age,
            'bio' => $this->bio,
        ]);

        session()->flash('success' , 'تم تعديل بياناتك بنجاح .');
        return redirect(route('volunteers.profile' , $this->user->volunteer->id));

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

        return redirect(route('volunteers.profile' , $this->user->volunteer->id));
    }
    public function removeImage()
    {
        $this->img = null ;
        $this->img_url = null;
    }
    public function render()
    {
        return view('livewire.volunteer.profile.update');
    }
}
