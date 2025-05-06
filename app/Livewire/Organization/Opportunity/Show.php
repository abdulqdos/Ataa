<?php

namespace App\Livewire\Organization\Opportunity;

use App\Livewire\OrganizationComponent;
use App\Models\Notification;
use App\Models\Opportunity;
use App\Models\Request;
use App\Models\VolunteerOpportunity;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

#[Title('الفرصة التطوعية')]
class Show extends OrganizationComponent
{
    use WithPagination;

    #[Url(as: 'q', except: '')]
    public ?Opportunity $opportunity;
    public $filterStatus, $modalType = false, $requestId = null, $currentRequest = null;
    public $activeTab = 'requests';

    public function mount(Opportunity $opportunity)
    {
        $this->opportunity = $opportunity;
    }

    public function updatedFilterStatus()
    {
        $this->resetPage();
    }

    public function setModel($type, $requestId = null)
    {
        $this->modalType = $type;
        $this->requestId = $requestId;
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    #[On('updateRequestStatus')]
    public function updateRequestStatus($status)
    {
        $this->currentRequest = Request::findOrFail($this->requestId);

        $this->changeStatus($status);
        $this->sendNotification($status, $this->currentRequest);

        if ($status === 'accepted') {
            VolunteerOpportunity::create([
                'volunteer_id' => $this->currentRequest->volunteer_id,
                'opportunity_id' => $this->opportunity->id,
            ]);
        }

        session()->flash('success', $status === 'accepted' ? 'تم قبول الطلب بنجاح.' : 'تم رفض الطلب بنجاح.');

        return redirect()->route('organization.opportunity.show', $this->opportunity);
    }

    public function changeStatus($status)
    {
        $this->currentRequest->update(['status' => $status]);

        if ($status === 'accepted') {
            $this->opportunity->increment('accepted_count');
        }
    }

    public function sendNotification($status, $request)
    {
        if ($status === 'accepted') {
            Notification::create([
                'title' => $this->opportunity->title,
                'message' => 'مبروك لقد تم قبولك في فرصة تطوعية، نرجو حضورك في الموعد المحدد.',
                'user_id' => $request->volunteer->user->id,
            ]);
        }
    }

    public function render()
    {
        $query = Request::where('opportunity_id', $this->opportunity->id);

        if (!empty($this->filterStatus)) {
            $query->where('status', $this->filterStatus);
        }

        return view('livewire.organization.opportunity.show', [
            'opportunity' => $this->opportunity,
            'volunteers' => $this->opportunity->volunteers(),
            'requests' => $query->orderBy('status', 'desc')->paginate(5),
        ]);
    }
}
