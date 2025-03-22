<?php

namespace App\Livewire\Organization\Opportunity;
use App\Livewire\OrganizationComponent;
use App\Models\Opportunity;
use Carbon\Carbon;
use Livewire\Attributes\Title;
use Livewire\WithFileUploads;

class Create extends OrganizationComponent
{
    use WithFileUploads ;
    #[title('إضافة فرصة تطوعية')]
    public $title  , $description , $start_date , $end_date , $location , $location_url , $count ;
    public $img , $img_url ;

    protected $rules = [
        'title' => 'required|min:3|max:20|string|regex:/^[^<>\/]*$/',
        'description' => 'required|min:10|max:255|string|regex:/^[^<>\/]*$/',
        'start_date' => 'required|date|after_or_equal:today|before:end_date',
        'end_date' => 'required|date|after:start_date',
        'location' => 'required|min:3|max:255|string|regex:/^[^<>\/]*$/',
        'location_url' => 'nullable|url',
        'count' => 'required|integer|min:1|regex:/^[^<>\/]*$/',
        'img' => 'required|image|max:1024',
    ];

    protected $messages = [

        // title
        'title.required' => 'العنوان مطلوب.',
        'title.min' => 'يجب أن يكون العنوان على الأقل 3 أحرف.',
        'title.max' => 'يجب ألا يتجاوز العنوان 20 حرفًا.',
        'title.string' => 'يجب أن يكون العنوان نصًا.',
        'title.regex' => 'العنوان لا يجب أن يحتوي على أكواد أو رموز غير مسموحة.',

        // description
        'description.required' => 'الوصف مطلوب.',
        'description.min' => 'يجب أن يكون الوصف على الأقل 10 أحرف.',
        'description.max' => 'يجب ألا يتجاوز الوصف 255 حرفًا.',
        'description.string' => 'يجب أن يكون الوصف نصًا.',
        'description.regex' => 'الوصف لا يجب أن يحتوي على أكواد أو رموز غير مسموحة.',

        // start
        'start_date.required' => 'تاريخ البداية مطلوب.',
        'start_date.date' => 'يجب أن يكون تاريخ البداية تاريخًا صحيحًا.',
        'start_date.before' => 'يجب أن يكون تاريخ البداية قبل تاريخ الانتهاء.',

        // end
        'end_date.required' => 'تاريخ الانتهاء مطلوب.',
        'end_date.date' => 'يجب أن يكون تاريخ الانتهاء تاريخًا صحيحًا.',
        'end_date.after' => 'يجب أن يكون تاريخ الانتهاء بعد تاريخ البداية.',

        // img
        'img.required' => 'الصورة مطلوبة.',
        'img.image' => 'يجب أن يكون الملف صورة بصيغة صحيحة.',
        'img.max' => 'يجب ألا يتجاوز حجم الصورة 1 ميجابايت.',

        // Location
        'location.required' => 'الموقع مطلوب.',
        'location.min' => 'الموقع يجب أن يحتوي على الأقل على 3 حروف.',
        'location.max' => 'الموقع يجب أن لا يتجاوز 20 حرفًا.',
        'location.string' => 'الموقع يجب أن يكون نصًا.',
        'location.regex' => 'الموقع لا يجب أن يحتوي على أحرف خاصة مثل < > /.',

        // Location_url
        'location_url.required' => 'رابط الموقع مطلوب.',
        'location_url.url' => 'رابط الموقع يجب أن يكون رابطًا صالحًا.',

        // Count
        'count.required' => 'عدد المتطوعين مطلوب.',
        'count.integer' => 'العدد يجب أن يكون عدد صحيح.',
        'count.min' => 'العدد يجب أن يكون على الأقل 1.',
        'count.regex' => 'العدد لا يجب أن يحتوي على أحرف خاصة مثل < > /.',
    ];

    public function store()
    {
        $organizationId = auth()->user()->organization?->id;

        $this->validate();

        if ($this->img && !app()->runningUnitTests()) {
            $this->img_url = $this->img->storePublicly('opportunity_images', ['disk' => 'public']);
        }

        Opportunity::create([
            'title' => $this->title,
            'description' => $this->description,
            'start_date' => Carbon::parse($this->start_date)->toDateString(),
            'end_date' => Carbon::parse($this->end_date)->toDateString(),
            'img_url' => $this->img_url,
            'location' => $this->location,
            'location_url' => $this->location_url,
            'count' => $this->count,
            'organization_id' => $organizationId,
        ]);

        return $this->redirect(route('organization.opportunity'));
    }

    public function removeImage()
    {
        $this->img = null;
        $this->img_url = '';
    }

    public function render()
    {
        return view('livewire.organization.opportunity.create');
    }
}
