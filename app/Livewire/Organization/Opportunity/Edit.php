<?php

namespace App\Livewire\Organization\Opportunity;

use App\Livewire\OrganizationComponent;
use App\Models\Opportunity;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends OrganizationComponent
{
    use WithFileUploads;

    #[Title('تعديل بيانات الفرصة')]

    // Inputs
    public $title, $description, $start_date, $end_date;
    public $img, $img_url;

    // Object
    public $opportunity;

    protected $rules = [
        'title' => 'required|min:3|max:20|string|regex:/^[^<>\/]*$/',
        'description' => 'required|min:10|max:255|string|regex:/^[^<>\/]*$/',
        'start_date' => 'required|date|after_or_equal:today|before:end_date',
        'end_date' => 'required|date|after:start_date',
        'img' => 'nullable|image|max:1024', // تغيير إلى nullable بدلاً من sometimes
    ];

    protected $messages = [
        'title.required' => 'العنوان مطلوب.',
        'title.min' => 'يجب أن يكون العنوان على الأقل 3 أحرف.',
        'title.max' => 'يجب ألا يتجاوز العنوان 20 حرفًا.',
        'title.string' => 'يجب أن يكون العنوان نصًا.',
        'title.regex' => 'العنوان لا يجب أن يحتوي على أكواد أو رموز غير مسموحة.',

        'description.required' => 'الوصف مطلوب.',
        'description.min' => 'يجب أن يكون الوصف على الأقل 10 أحرف.',
        'description.max' => 'يجب ألا يتجاوز الوصف 255 حرفًا.',
        'description.string' => 'يجب أن يكون الوصف نصًا.',
        'description.regex' => 'الوصف لا يجب أن يحتوي على أكواد أو رموز غير مسموحة.',

        'start_date.required' => 'تاريخ البداية مطلوب.',
        'start_date.date' => 'يجب أن يكون تاريخ البداية تاريخًا صحيحًا.',
        'start_date.before' => 'يجب أن يكون تاريخ البداية قبل تاريخ الانتهاء.',

        'end_date.required' => 'تاريخ الانتهاء مطلوب.',
        'end_date.date' => 'يجب أن يكون تاريخ الانتهاء تاريخًا صحيحًا.',
        'end_date.after' => 'يجب أن يكون تاريخ الانتهاء بعد تاريخ البداية.',

        'img.image' => 'يجب أن يكون الملف صورة بصيغة صحيحة.',
        'img.max' => 'يجب ألا يتجاوز حجم الصورة 1 ميجابايت.',
    ];

    public function mount(Opportunity $opportunity)
    {
        $this->title = $opportunity->title;
        $this->description = $opportunity->description;
        $this->start_date = Carbon::parse($this->opportunity->start_date)->format('Y-m-d');
        $this->end_date = Carbon::parse($this->opportunity->end_date)->format('Y-m-d');
        $this->img_url = $opportunity->img_url;
        $this->opportunity = $opportunity;
    }

    public function removeImage()
    {
        $this->img = null;
        $this->img_url = '';
    }

    public function update()
    {
        $organizationId = auth()->user()->organization?->id;

        // validation img
        if (!$this->img_url && !$this->img) {
            $this->addError('img', 'الصورة مطلوبة.');
            return;
        }

        $this->validate();

        if ($this->img) {
            if ($this->opportunity->img_url) {
                Storage::disk('public')->delete($this->opportunity->img_url);
            }

            $this->img_url = $this->img->store('opportunities_photos', 'public');
        }

        // update data
        $this->opportunity->update([
            'title' => $this->title,
            'description' => $this->description,
            'start_date' => Carbon::parse($this->start_date)->toDateString(),
            'end_date' => Carbon::parse($this->end_date)->toDateString(),
            'img_url' => $this->img_url,
            'organization_id' => $organizationId,
        ]);

        return $this->redirect(route('organization.opportunity'));
    }

    public function render()
    {
        return view('livewire.organization.opportunity.edit');
    }
}
