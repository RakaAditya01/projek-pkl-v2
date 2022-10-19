<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $data = User::paginate();
        return view('expired\user',compact('data'));
    }

    public function tambahuser(){
        $user = User::all();
        return view('expired.tambah',compact('user'));
    }

    public function store(request $request){
        user::create([
            'name' => $request->name,
            'nim' => $request->nim,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'expired_at' => Carbon::now()->addMonths(6),
            'remember_token' => Str::random(60)
        ]);
        // $coupon = Coupon::where('code', $request->get('coupon'))->first();

        // if (!empty($coupon) && $coupon->expire_date );
        // return redirect('/user');
    }

    public function tampilanUser($id){
        $data = User::find ($id);
        return view('expired\user',compact('data'));
    }

    public function update(request $request, $id){  
        $data = User::find($id);
        $data->update($request->all());
        return redirect()->route('user')->with('success', 'Data Berhasil Di Edit!');;
    }   

    public function destroy($id){
        $data = User::first();
        $data->delete();
        return redirect()->route('user');
    }
}
