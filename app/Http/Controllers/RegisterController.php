<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Symfony\Component\HttpFoundation\Response;
// use Illuminate\Auth\Passwords\PasswordBroker;

class RegisterController extends Controller
{
    public function register(){
        return view('pages.auth-register');
    }

    public function registeruser(Request $request){
        $request-> validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|numeric|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required','confirmed', Rules\Password::min(8)],
            'captcha' => 'required|captcha'
        ]);

        $user = User::insert([
            'name' => $request->name,
            'nim' => $request->nim,
            'email' => $request->email,
            'password' => Hash::make($request['password']),
            'pswrd' => $request->password,
            'expired_at' => Carbon::now()->addMonths(6),
            'remember_token' => Str::random(60),
            'created_at'=> now(),
        ]);
        $User = User::where('name', $request->get('user'))->first();
        if (!empty($User) && $User->expired_at );
        return redirect('/auth-login2');
        if (!Hash::check(request ('password'), $User->password)) {
        return new Response('Invalid Password');
        }
    }
}
