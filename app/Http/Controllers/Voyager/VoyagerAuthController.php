<?php

namespace App\Http\Controllers\Voyager;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Facades\Voyager;

use TCG\Voyager\Http\Controllers\VoyagerAuthController as BaseVoyagerAuthController;

class VoyagerAuthController extends BaseVoyagerAuthController
{
    
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username()=>'required|string',
            'password'=>'required|string'
        ]);
    }
}
