<?php

namespace App\Http\Livewire\App\Dashboard\P2p\Component;

use Livewire\Component;

class NominalCard extends Component
{
    public $title;
    public $nominal;
    public $percent;

    public function mount($title,$nominal,$percent)
    {
        $this->title = $title;
        $this->nominal = $nominal;
        $this->percent = $percent;
    }

    public function render()
    {
        return view('livewire.app.dashboard.p2p.component.nominal-card');
    }
}
