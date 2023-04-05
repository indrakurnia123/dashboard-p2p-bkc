<?php

namespace App\Http\Livewire\App\Component\Dashboard;

use Livewire\Component;

class InfoCard extends Component
{
    public $title;
    public $mainValue;
    public $subValue;
    public $chartType;

    public function mount($title,$mainValue,$subValue,$chartType)
    {
        $this->title = $title;
        $this->mainValue = $mainValue;
        $this->subValue = $subValue;
        $this->chartType = $chartType;
    }

    public function render()
    {
        return view('livewire.app.component.dashboard.info-card');
    }
}
