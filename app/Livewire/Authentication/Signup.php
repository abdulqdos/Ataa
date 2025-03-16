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
        'user_name' => 'required|string|regex:/^[a-zA-Z]+$/u|min:4|max:20',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8|max:20|confirmed',
    ];

    // Volunteer Fields
    protected $volunteerRules = [
        'first_name' => 'required|string|min:2|max:50',
        'last_name' => 'required|string|min:2|max:50',
        'gender' => 'required|in:male,female',
        'education_level' => 'required|string|max:100',
        'age' => 'required|integer',
    ];

    // Organization Fields
    protected $organizationRules = [
        'name' => 'required|string|min:2|max:50',
        'city' => 'required',
        'sector' => 'required',
    ];

    // Define variables
    public $user_name, $email, $password, $password_confirmation, $userType;
    public $first_name, $last_name, $gender, $education_level, $age;
    public $name, $city, $sector;

    // Error messages for validation
    protected $messages = [
        'user_name.required' => 'اسم المستخدم مطلوب.',
        // ... other error messages here ...
    ];

    // Handle registration based on userType
    public function register()
    {
        // Apply common validation
        $this->validate(array_merge($this->commonRules, $this->userType === 'volunteer' ? $this->volunteerRules : $this->organizationRules));

        if ($this->userType === 'volunteer') {

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
                'education_level' => $this->education_level,
                'age' => $this->age,
                'user_id' => $user->id,
            ]);

            // Log in the user and redirect
            Auth::login($user);
            session()->flash('success', 'تم إنشى حسابك بنجاح (: اتمنى لك رحلة تطوعية مليئة بالعطاء');
            $this->redirectRoute('home', navigate: true);

        } elseif ($this->userType === 'organization') {

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
                'user_id' => $user->id,
            ]);

            // Log in the user and redirect
            Auth::login($user);
            session()->flash('success', 'تم إنشى حسابك بنجاح (: اتمنى لك رحلة تطوعية مليئة بالعطاء');
            $this->redirectRoute('organization.dashboard', navigate: true);
        }


    }

    public function render()
    {
        return view('livewire.authentication.signup', [
            'cities' => City::all(),
            'sectors' => Sector::all(),
        ]);
    }
}
