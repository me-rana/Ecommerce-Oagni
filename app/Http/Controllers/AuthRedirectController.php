<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthRedirectController extends Controller
{
    //
    protected function mydashboard(){
        if(Auth::user()->role == 1){
            return redirect()->route('customer.dashboard');
        }
        else if(Auth::user()->role == 2){
            return redirect()->route('seller.dashboard');
        }
        else if(Auth::user()->role == 3){
            return redirect()->route('admin.dashboard');
        }

        else{
            return redirect()->route('dashboard');
        }
    }
}
