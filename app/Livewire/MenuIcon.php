<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class MenuIcon extends Component
{
    public $show = false;

    #[on('toggle-show-menu-list')]
    public function toggleShowMenuList()
    {
        $this->show = !$this->show;
    }
    public function render()
    {
        return view('livewire.menu-icon');
    }
}
