<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email;
    public $password;

    public function login()
    {
        $this->validate([
            'email'     => 'required|email',
            'password'  => 'required'
        ]);

        if(Auth::attempt(['email' => $this->email, 'password'=> $this->password])) {
            
            $this->dispatchBrowserEvent('swal:fire',[
                'position'=>'center',
                'icon'=>'success',
                'title'=>'Berhasil',
            ]);
            return redirect()->route('dashboard.p2p-lending');  
        }else{
            
            $this->dispatchBrowserEvent('swal:fire',[
                'position'=>'center',
                'icon'=>'error',
                'title'=>'Gagal Login',
            ]);
        }
    }

    public function render()
    {
        return view('livewire.auth.login')->extends('layouts.login');
    }
}
