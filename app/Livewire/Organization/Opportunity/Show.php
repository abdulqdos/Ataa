<?php

namespace App\Livewire\Organization\Opportunity;

use App\Livewire\OrganizationComponent;
use App\Models\Opportunity;
use App\Models\Request;
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
