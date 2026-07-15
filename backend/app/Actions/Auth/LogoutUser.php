<?php

namespace App\Actions\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class LogoutUser
{


    public function handle(Request $request) 
    {
        Auth::logout();
        $request->user()->currentAccessToken()->delete();
        return true; // success
    }
}
