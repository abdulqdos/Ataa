<?php

namespace App\Livewire\Organization\Requests\Document;

use App\Livewire\OrganizationComponent;
use App\Models\Opportunity;
use App\Models\Request;
use App\Models\Volunteer;
use App\Models\VolunteerOpportunity;
use Livewire\Attributes\Title;
use Livewire\WithFileUploads;

#[Title('إعداد توثيق')]
class Create extends OrganizationComponent
{
    use withFileUploads;

    public $description, $hours, $participation_date, $report, $eval_commitment, $eval_teamwork, $eval_leadership, $opportunity, $volunteer, $certificate_path, $certificate , $request;

    public function mount(Opportunity $opportunity, Request $request)
    {
        $this->opportunity = $opportunity;
        $this->request = $request;
        $this->volunteer = $request->volunteer;
    }

    protected $rules = [
        'description' => 'required|string|max:255',
        'hours' => 'required|integer|min:1',
        'participation_date' => 'required|date|before_or_equal:today',
        'report' => 'required|string|max:1000',
        'eval_commitment' => 'required|integer|min:1|max:5',
        'eval_teamwork' => 'required|integer|min:1|max:5',
        'eval_leadership' => 'required|integer|min:1|max:5',
        'certificate' => 'nullable|file|mimes:pdf|max:2048'
    ];
    protected $messages = [
        'description.required' => 'وصف النشاط مطلوب.',
        'description.string' => 'وصف النشاط يجب أن يكون نصًا.',
        'description.max' => 'وصف النشاط يجب أن لا يتجاوز 255 حرفًا.',

        'hours.required' => 'عدد الساعات مطلوب.',
        'hours.integer' => 'عدد الساعات يجب أن يكون عددًا صحيحًا.',
        'hours.min' => 'عدد الساعات يجب أن لا يقل عن 1.',
        'hours.max' => 'عدد الساعات يجب أن لا يتجاوز 24 ساعة.',

        'participation_date.required' => 'تاريخ المشاركة مطلوب.',
        'participation_date.date' => 'تاريخ المشاركة يجب أن يكون تاريخًا صالحًا.',
        'participation_date.before_or_equal' => 'تاريخ المشاركة يجب أن يكون قبل أو في نفس تاريخ اليوم.',

        'report.required' => 'التقرير مطلوب.',
        'report.string' => 'التقرير يجب أن يكون نصًا.',
        'report.max' => 'التقرير يجب أن لا يتجاوز 1000 حرف.',

        'eval_commitment.required' => 'التقييم في الالتزام مطلوب.',
        'eval_commitment.integer' => 'التقييم في الالتزام يجب أن يكون عددًا صحيحًا.',
        'eval_commitment.min' => 'التقييم في الالتزام يجب أن يكون بين 1 و 5.',
        'eval_commitment.max' => 'التقييم في الالتزام يجب أن يكون بين 1 و 5.',

        'eval_teamwork.required' => 'التقييم في العمل الجماعي مطلوب.',
        'eval_teamwork.integer' => 'التقييم في العمل الجماعي يجب أن يكون عددًا صحيحًا.',
        'eval_teamwork.min' => 'التقييم في العمل الجماعي يجب أن يكون بين 1 و 5.',
        'eval_teamwork.max' => 'التقييم في العمل الجماعي يجب أن يكون بين 1 و 5.',

        'eval_leadership.required' => 'التقييم في القيادة مطلوب.',
        'eval_leadership.integer' => 'التقييم في القيادة يجب أن يكون عددًا صحيحًا.',
        'eval_leadership.min' => 'التقييم في القيادة يجب أن يكون بين 1 و 5.',
        'eval_leadership.max' => 'التقييم في القيادة يجب أن يكون بين 1 و 5.',

        'certificate.file' => 'الملف المُرفق يجب أن يكون ملفًا صالحًا.',
        'certificate.mimes' => 'يجب أن يكون نوع الملف PDF فقط.',
        'certificate.max' => 'يجب ألا يتجاوز حجم الملف 2 ميغابايت.',
    ];

    public function store()
    {
        $this->validate();

        if ($this->certificate && !app()->runningUnitTests()) {
            $this->certificate_path = $this->certificate->storePublicly('certificates_images', ['disk' => 'public']);
        }

//        @dd($this->certificate_path);
        $this->opportunity->volunteers()->updateExistingPivot($this->volunteer->id, [
            'description' => $this->description,
            'hours' => $this->hours,
            'participation_date' => $this->participation_date,
            'report' => $this->report,
            'eval_commitment' => $this->eval_commitment,
            'eval_teamwork' => $this->eval_teamwork,
            'eval_leadership' => $this->eval_leadership,
            'eval_total' => ($this->eval_commitment + $this->eval_teamwork + $this->eval_leadership) / 3,
            'certificate_path' => $this->certificate_path,
        ]);

        $this->request->status = 'accepted' ;
        $this->request->save();

        return redirect(route('organization.opportunities-requests.requests', $this->opportunity->id))->with('success', 'تم توثيق نشاط المتطوع بنجاح');
    }


    public function render()
    {
        return view('livewire.organization.requests.document.create');
    }

}






