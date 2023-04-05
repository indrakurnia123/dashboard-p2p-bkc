<?php

namespace App\Http\Livewire\App\Component;

use Livewire\Component;

class Sidebar extends Component
{
    public function render()
    {
        // dd(menu('dashboard_user','_json'));
        return view('livewire.app.component.sidebar');
    }
}
