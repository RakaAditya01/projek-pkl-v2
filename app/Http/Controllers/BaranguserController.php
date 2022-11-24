<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjam;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class BaranguserController extends Controller
{
    public function index(){
        $data = Barang::paginate();
        // dd($data);
        return view('user\baranguser',compact('data'));
    }

    // public function baranguser($id)
    // {
    //     $barang = Barang::select('nama_barang')->find($id);
    //     return redirect('user\history' , compact('barang'));
    // }
    // public function namadannim(Request $request)
    // {
    //     return response()->json([
    //         'r' =>'pantek',
    //     ]);
    // }

    public function pinjamuser(){
        $barang = Barang ::all();
        return view('user\pinjamuser' , compact('barang'));
        return redirect(route('history'));
    }

    public function store(request $request){
        $data = Peminjam::create ($request->all());
        if($request->hasFile('dokumentasi')){
            $request->file('dokumentasi')->move('fotodokumentasi/', $request->file('dokumentasi')->getClientOriginalName());
            $data->dokumentasi = $request->file('dokumentasi')->getClientOriginalName();
            $data -> expired_at = Carbon::today()->addWeeks(1)->toDateString();
            $data->save();
        }  
            
        return redirect(route('history'));
    }
}
