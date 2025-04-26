<?php

namespace App\Livewire\Organization\Profile ;

use App\Livewire\OrganizationComponent;
use App\Models\City;
use App\Models\Sector;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends OrganizationComponent
{
    use withFileUploads ;
    #[title('تعديل ملف الشخصي')]
    public $user , $user_name , $email ,  $img , $img_url , $bio  , $name , $contact_email , $phone_number , $city_id, $sector_id ;
    public $old_password , $new_password , $new_password_confirmation;

    // rules
    protected $rules = [
        'user_name' => 'required|string|min:3|max:50',
        'email' => 'required|email|unique:users,email',
        'bio' => 'nullable|string|max:500',
        'img' => 'nullable|image|max:2048', // 2MB Max
        'img_url' => 'nullable|url',
        'nam' => 'required|string|min:2|max:100',
        'contact_email' => 'nullable|email',
        'phone_number' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:6|max:20',
        'city' => 'required|exists:cities,id',
        'sector' => 'required|exists:sectors,id',
        'old_password' => ['required'],
        'new_password' => ['required', 'min:8', 'confirmed'],
    ];

    protected $messages = [
        'user_name.required' => 'اسم المستخدم مطلوب.',
        'user_name.string' => 'اسم المستخدم يجب أن يكون نص.',
        'user_name.min' => 'اسم المستخدم يجب أن يكون على الأقل 3 حروف.',
        'user_name.max' => 'اسم المستخدم لا يجب أن يتجاوز 50 حرف.',

        'bio.max' => 'السيرة الذاتية لا يجب أن تتجاوز 500 حرف.',

        'img.image' => 'يجب أن يكون الملف صورة.',
        'img.max' => 'حجم الصورة لا يجب أن يتجاوز 2 ميغابايت.',

        'img_url.url' => 'رابط الصورة غير صالح.',

        'nam.required' => 'الاسم مطلوب.',
        'nam.min' => 'الاسم يجب أن يحتوي على حرفين على الأقل.',
        'nam.max' => 'الاسم لا يجب أن يتجاوز 100 حرف.',

        'contact_email.email' => 'يرجى إدخال بريد إلكتروني صالح للتواصل.',

        'phone_number.regex' => 'رقم الهاتف يحتوي على رموز غير صالحة.',
        'phone_number.min' => 'رقم الهاتف قصير جداً.',
        'phone_number.max' => 'رقم الهاتف طويل جداً.',

        'city.required' => 'المدينة مطلوبة.',
        'city.exists' => 'المدينة غير موجودة.',

        'sector.required' => 'القطاع مطلوب.',
        'sector.exists' => 'القطاع غير موجود.',
    ];

    // Just For email
    public function rules()
    {
        return [
            'email' => 'required|email|max:255|unique:users,email,' . $this->user->id,
        ];
    }

    public function mount()
    {
        $this->user = auth()->user();
        $this->user_name = $this->user->user_name;
        $this->email = $this->user->email;
        $this->img_url =  $this->user->img_url ;
         $this->name = $this->user->organization->name ;
         $this->contact_email = $this->user->organization->contact_email;
         $this->city_id = $this->user->organization->city_id ;
         $this->sector_id = $this->user->organization->sector_id ;
        $this->phone_number = $this->user->organization->phone_number ;
        $this->bio = $this->user->organization->bio ;
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

        return redirect(route('organization.update-profile'));
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


        $this->user->organization->update([
            'name' => $this->name,
            'contact_email' => $this->contact_email,
            'phone_number' => $this->phone_number,
            'city_id' => $this->city_id,
            'sector_id' => $this->sector_id,
            'bio' => $this->bio,
        ]);

        session()->flash('success' , 'تم تعديل بياناتك بنجاح .');
        return redirect(route('organization.update-profile'));

    }
    public function removeImage()
    {
        $this->img = null ;
        $this->img_url = null;
    }

    public function updatePassword()
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

        return redirect(route('organization.update-profile'));
    }
    public function render()
    {
        return view('livewire.organization.profile.update' , [
            'sectors' => Sector::all(),
            'cities' => City::all(),
        ]);
    }
}
