<?php

namespace App\Livewire\Organization\Volunteers;

use App\Livewire\OrganizationComponent;
use App\Models\Notification;
use App\Models\Opportunity;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Title('إدارة المتطوعون - قائمة المتطوعون')]
class Index extends organizationComponent
{
    use withPagination ;
    public $opportunity  , $searchText , $status , $showBox = false , $title , $message ;


    public function mount(Opportunity $opportunity)
    {
        $this->opportunity = $opportunity;
        $this->status = $this->opportunity->getStatus();
    }

    public function updated()
    {
        $this->resetPage();
    }

    #[On('search:clear')]
    public function clear()
    {
        $this->reset('searchText', 'status');
    }

    public function getVolunteers()
    {
        $query = $this->opportunity->volunteers()->withPivot('hours');

        if(!empty($this->searchText))
        {
            $query->where('first_name', 'like', '%' . $this->searchText . '%')->orWhere('last_name', 'like', '%' . $this->searchText . '%');
        }

        return $query ;
    }


    public function toggleShowBox()
    {
        $this->showBox = !$this->showBox  ;
    }

    public function sendNotification()
    {
        $volunteers =  $this->opportunity->volunteers();
//
        $this->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string|max:500',
        ], [
            'title.required' => 'يرجى إدخال عنوان الإشعار.',
            'message.required' => 'يرجى إدخال محتوى الإشعار.',
            'title.max' => 'عنوان الإشعار طويل جدًا.',
            'message.max' => 'محتوى الإشعار طويل جدًا.',
        ]);

        $volunteers = $this->opportunity->volunteers()->with('user')->get();

        foreach ($volunteers as $volunteer) {
            Notification::create([
                'user_id' => $volunteer->user->id,
                'title' => $this->title . "من فرصة تطوعية باسم" . $this->opportunity->title ,
                'message' => $this->message,
            ]);
        }

        // إعادة تعيين القيم وإغلاق الصندوق
        $this->reset(['title', 'message', 'showBox']);

        session()->flash('success', 'تم إرسال الإشعار بنجاح إلى جميع المتطوعين.');

        return redirect(route('organization.volunteers' , $this->opportunity));
    }



    public function render()
    {
        $volunteers = $this->getVolunteers();
        return view('livewire.organization.volunteers.index' , [
            'volunteers' => $volunteers->latest()->paginate(10),
            'opportunity' => $this->opportunity,
            'status' =>  $this->status
        ]);
    }
}
