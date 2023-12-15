<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthRedirectController extends Controller
{
    //
    protected function mydashboard(){
        if(Auth::user()->usertype == 1){
            return redirect()->route('Dashboard (Customer)');
        }
        else if(Auth::user()->usertype == 2){
            return redirect()->route('Dashboard (Seller)');
        }
        else if(Auth::user()->usertype == 3){
            return redirect()->route('Dashboard (Admin)');
        }

        else{
            return redirect()->route('Home');
        }
    }
}
