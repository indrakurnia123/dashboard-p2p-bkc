<?php

namespace App\Http\Livewire\App\Component;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Navbar extends Component
{
    
    public function logout()
    {   
        Auth::logout();
        return redirect()->route('dashboard.login');
    }

    public function render()
    {
        return view('livewire.app.component.navbar');
    }
}
