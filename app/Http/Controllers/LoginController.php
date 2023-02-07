<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class LoginController extends Controller
{

    public function login(){
        return view('/dashboard-general-dashboard');
    }

    public function loginproses(Request $request)
    {
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            // 'expired_at' => 
        ];

        if (Auth::Attempt($data)) {
            $email = $request->input('email');
            $user = User::where('email', $email)->first();
            session()->put('name',$user->name);
            return redirect('/dashboard-general-dashboard');    
        }else{
            session()->flash('error', 'Email atau Password Salah');
            return redirect()->back();
        }
    }


    public function register(){
        return view('pages.auth-register');
    }
    
    public function registeruser(Request $request){
        user::create([
            'name' => $request->name,
            'nim' => $request->nis,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'expired_at' => Carbon::now()->addMonths(6),
            'remember_token' => Str::random(60)
        ]);
        return redirect('/auth-login2');
        $validator = Validator::make($input, $rules);
    }

    // recaptcha
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required|string|confirmed', Password::min(8)->mixedCase()],
            'password_confirmation'=> ['required_with:password|same:password|min:8'],
            'captcha' => ['required','captcha'],
        ]);
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
        return redirect('/auth-login2')->with('logout','logout success!!');
    }
}
