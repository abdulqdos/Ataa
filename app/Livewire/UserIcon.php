<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class UserIcon extends Component
{
    public $show = false , $showList = false ;

    public function toggleShow()
    {
        $this->show = !$this->show;
    }

    #[on('reset-user-icon')]
    public function resetUserIcon()
    {
        $this->show = false ;
    }

    public function render()
    {
        return view('livewire.user-icon');
    }
}
