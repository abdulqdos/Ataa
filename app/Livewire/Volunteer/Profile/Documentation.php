<?php

namespace App\Livewire\Volunteer\Profile;

use App\Models\Opportunity;
use App\Models\Request;
use App\Models\VolunteerOpportunity;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Title;
use Livewire\Component;
use Symfony\Component\HttpFoundation\StreamedResponse;

#[Title('مشاركتي')]
class Documentation extends Component
{
    public $opportunity , $organization , $showDeleteBox , $id ;
    public function mount(Opportunity $opportunity)
    {
        $this->id = $opportunity->id ;
        $this->opportunity = DB::table('volunteer_opportunities')
            ->where('opportunity_id', $opportunity->id)
            ->Where('volunteer_id' , auth()->user()->volunteer->id)
            ->first();

        $this->organization = $opportunity->organization ;
    }

    public function toggleShowBox()
    {
        $this->showDeleteBox = true;
    }

    public function makeRequest()
    {
        if (!$this->id) {
            session()->flash('success', 'لا توجد فرصة تطوعية لي ارسال طلب .');
            return;
        }

        Request::create([
            'opportunity_id' => $this->id,
            'volunteer_id' => auth()->user()?->volunteer->id,
            'reason' => 'رجاء القيام بتوثيق نشاطي',
            'type' => 'document',
        ]);

        return redirect()->route('volunteers.myOpportunity.documentation' , ['opportunity' => $this->id]  )->with('success', 'تم إرسال طلب توثيق الفرصة التطوعية بنجاح');
    }

    public function resetDeleteBox()
    {
        $this->showDeleteBox = false;
    }

    public function downloadCertificate()
    {
        $filename = 'certificate.pdf';

        return response()->download(
            Storage::disk('public')->path($this->opportunity->certificate_path),
            $filename
        );
    }
    public function render()
    {
        return view('livewire.volunteer.profile.documentation' ,
        [
            'opportunity' => $this->opportunity,
            'organization' => $this->organization,
            'flag' => Request::where('volunteer_id' , auth()->user()?->volunteer->id)->where('opportunity_id' , $this->id)->where('type' , 'document')->first(),
        ]);
    }
}
