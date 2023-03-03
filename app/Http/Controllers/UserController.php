<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $data = User::paginate(9999999999);
        return view('expired.user',compact('data'));
    }

    public function pdfuser() {
        $data = User::all();
        $pdf = PDF::loadView('pdfuser', ['data' => $data]);
        return $pdf->stream('user.pdf');
    }

    public function tambahuser(){
        $user = User::all();
        return view('expired.tambah',compact('user'))->with('toast_success', 'Data Berhasil Di Edit!');;
    }

    public function store(request $request){
        user::create([
            'name' => $request->name,
            'nim' => $request->nim,
            'email' => $request->email,
            'pswrd' => $request->password,
            'role' => $request->role,
            'password' => Hash::make($request['password']),
            'expired_at' => Carbon::now()->addMonths(6),
            'remember_token' => Str::random(60),
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);
        return redirect(route('user'));
    }

    public function tampilanUser($id){
        $data = User::find ($id);
        return view('expired.edit',compact('data'))->with('toast_success', 'Data Berhasil Di Edit!');;
    }

    public function update(request $request, $id){  
        $data = User::find($id);
        $request['password'] = Hash::make($request['password']);
        $data->update($request->all());
        return redirect('user')->with('toast_success', 'Data Berhasil Di Edit!');;
    }   

    public function destroy($id){
        $data = User::find($id);
        $data->delete();
        return redirect('user')->with('toast_success', 'Data Berhasil Di Edit!');;
    }
}
