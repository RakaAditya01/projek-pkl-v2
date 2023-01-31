<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjam;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    public function index(){
        $user = Auth::user()->nim;
        $data = Peminjam::where('nim' ,'=', "$user")
                ->paginate(9999999999);
        return view('user.history',compact('data'));
    }
    
    public function destroy($id){
        $data = Peminjam::find($id);
        $data->delete();
        return redirect()->route('history')->with('toast_success', 'Data Berhasil Di Hapus!');;
    }
}
