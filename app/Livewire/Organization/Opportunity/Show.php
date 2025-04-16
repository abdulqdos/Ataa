<?php

namespace App\Livewire\Organization\Opportunity;

use App\Livewire\OrganizationComponent;
use App\Models\Notification;
use App\Models\Opportunity;
use App\Models\Request;
use App\Models\VolunteerOpportunity;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class Show extends OrganizationComponent
{
    use WithPagination;
    #[Url(as: 'q', except: '')]
    #[title('الفرصة التطوعية')]

    public ?Opportunity $opportunity ;
    public $filterStatus  , $modalType = false ,  $requestId = null , $currentRequest = null ;
    public function mount(Opportunity $opportunity)
    {
        $this->opportunity = $opportunity;
    }

    public function updatedFilterStatus()
    {
        $this->resetPage();
    }

    public function setModel($type  , $requestId = null)
    {
        $this->modalType = $type;
        $this->requestId = $requestId;
    }

    public function updateRequestStatus($status)
    {
        // Find Request
        $this->currentRequest = Request::findOrFail($this->requestId);

        // change Status
        $this->changeStatus($status);

        // Send Notification
        $this->sendNotification($status , $this->currentRequest );

        VolunteerOpportunity::create([
            'volunteer_id' => $this->currentRequest->volunteer_id,
            'opportunity_id' => $this->opportunity->id,
        ]);

        // Set Session message
        $message = $status === 'accepted' ? 'تم قبول الطلب بنجاح.' : ($status === 'declined' ? 'تم رفض الطلب بنجاح.' : 'حالة غير معروفة');
        session()->flash('success', $message);

        // Redirect To Show Page
        return redirect()->route('organization.opportunity.show', $this->opportunity);
    }

    public function changeStatus($status)
    {
        $this->currentRequest->update([
            'status' => $status,
        ]);

        if ($status === 'accepted') {
            $this->opportunity->update([
                'accepted_count' => $this->opportunity->accepted_count++,
            ]);
        }
    }

    public function sendNotification($status , $request )
    {
        if ($status === 'accepted') {
            Notification::create([
                'title' => $this->opportunity->title,
                'message' => 'مبروك لقد تم قبولك في فرصة تطوعية , نرجى منك حضور في موعد محدد .',
                'read_at' => null,
                'user_id' => $request->volunteer->user->id,
            ]);
        }

        return ;
    }

    public function render()
    {
        $query = Request::where('opportunity_id' , $this->opportunity->id);

        if (!empty($this->filterStatus)) {
            $query->where('status', $this->filterStatus);
        }

        return view('livewire.organization.opportunity.show' , [
            'opportunity' => $this->opportunity,
            'requests' => $query->orderBy('status' , 'desc')->paginate(5),
        ]);
    }
}
