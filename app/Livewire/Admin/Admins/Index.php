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
