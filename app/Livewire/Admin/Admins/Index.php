<?php

namespace App\Livewire\Admin\Admins;

use App\Livewire\AdminComponent;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;

use Livewire\WithPagination;

#[Title('مشرفون النظام')]
class Index extends AdminComponent
{
     use WithPagination ;
    #[Url(as: 'q', except: '')]
    public $searchText ;
    public $showDeleteBox = false;
    public $selectedAdmin = null;


    public function toggleShowDeleteBox(User $admin)
    {
        $this->selectedAdmin = $admin;
        $this->showDeleteBox = true;
    }

    public function confirmDelete()
    {
        if (!$this->selectedAdmin) {
            session()->flash('error', 'لا توجد فرصة تطوعية محددة للحذف.');
            return;
        }

        $this->selectedAdmin->delete();
        $this->reset(['selectedAdmin']);
        return redirect()->route('admin.admins')->with('success', 'تم حذف المشرف بنجاح');
    }

    public function resetDeleteBox()
    {
        $this->showDeleteBox = false;
        $this->selectedAdmin = null;
    }
    public function getAdmins()
    {
        $query = User::where('role' ,'admin');

        if(!empty($this->searchText))
        {
            $query->where('user_name', 'like', '%' . $this->searchText . '%');
        }

        return $query;
    }

    public function clear()
    {
        $this->searchText = '';
    }

    public function updated()
    {
        $this->resetPage();
    }
    public function render()
    {
        $admins = $this->getAdmins();
        return view('livewire.admin.admins.index' ,
        [
            'admins' => $admins->paginate(9),
        ]);
    }
}
