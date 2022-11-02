<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class LoginController extends Controller
{
   
    public function login(){
    
        return view('/dashboard-general-dashboard');
    }

    public function loginproses(Request $request)
    {
        if(Auth::attempt($request->only('email','password'))){
            return redirect('/dashboard-general-dashboard');
        }
        return redirect('/auth-login2');
    }
   
    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
 
        request()->session()->invalidate();
        
        request()->session()->regenerateToken();
 
        return redirect('/login');
    }
}
