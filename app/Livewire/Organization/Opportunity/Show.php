<?php

namespace App\Livewire\Organization\Opportunity;

use App\Livewire\OrganizationComponent;
use App\Models\Notification;
use App\Models\Opportunity;
use App\Models\Request;
use App\Models\Volunteer;
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
    public $searchText;
    public function mount(Opportunity $opportunity)
    {
        $this->opportunity = $opportunity;
    }

    public function updatedFilterStatus()
    {
        $this->resetPage();
    }

    public function updatedSearchText()
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
                'message' => 'مبروك لقد تم قبولك في فرصة تطوعية، نرجو حضورك في الموعد المحدد .',
                'user_id' => $request->volunteer->user->id,
            ]);
        }
    }

    public function getRequests()
    {
        $query = Request::where('opportunity_id', $this->opportunity->id);

        if (!empty($this->filterStatus)) {
            $query->where('status', $this->filterStatus);
        }

        return $query;
    }


    public function getVolunteers()
    {
        $query  = $this->opportunity->volunteers();

        if (!empty($this->searchText)) {
            $query  = $query ->where(function ($q) {
                $q->where('first_name', 'like', '%' . $this->searchText . '%')
                    ->orWhere('last_name', 'like', '%' . $this->searchText . '%');
            });
        }

        return $query ;
    }
    public function render()
    {
        $requests = $this->getRequests();
        $volunteers = $this->getVolunteers();
        return view('livewire.organization.opportunity.show', [
            'opportunity' => $this->opportunity,
            'volunteers' => $volunteers->paginate(10),
            'requests' => $requests->orderBy('status', 'desc')->paginate(5),
            'status' => $this->opportunity->getStatus()
        ]);
    }
}
