<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjam;
use Alert;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BaranguserController extends Controller
{

    public function index(){
        $data = Barang::paginate();
        // dd($data);
        return view('user\baranguser',compact('data'));
    }

    public function pinjamuser($id){
        // $barang = Barang ::all();
        $barang = DB::table('barangs')->where('id',$id)->find($id);
        // dd($data);
        return view('user\pinjamuser' , compact('barang'));
        return redirect(route('history'));
    }

    public function store(request $request){
        if($request->image){
            $img =  $request->get('image');
            $image_parts = explode(";base64,", $img);
            foreach ($image_parts as $row => $image){
                $image_base64 = base64_decode($image);
            }
            // dd($fileName);
            $upload= cloudinary()->upload($img)->getSecurePath();
            $id = auth()->user()->nim;
            $nama = auth()->user()->name;
            $data = Peminjam::insert([
                'nama_barang' => $request->nama_barang,
                'image' => $upload,
                'nama' => $nama,
                'nim' => $id,
                'keterangan' =>$request->keterangan,
                'jumlah' =>$request->jumlah,
                'expired_at' => Carbon::today()->addWeeks(1)->toDateString(),
                'created_at' => now(),
            ]);
            // dd($data);
        }  
            
        return redirect('history')->with('toast_success', 'Data Berhasil Di Simpan!');;
    }
}
