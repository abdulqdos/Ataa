<?php

namespace App\Livewire;

use App\Models\Opportunity;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class Opportunities extends Component
{
    use withPagination;
    #[title('الفرص التطوعية')]
    public $header ;

    public function mount($header = 'none')
    {
        $this->header = 'كل الفرص';
    }

    public $pageName = 'opportunities';
    public function render()
    {
        return view('livewire.opportunities' ,
            [
                'opportunities' => Opportunity::latest()->paginate(12),
            ]
        );
    }
}
