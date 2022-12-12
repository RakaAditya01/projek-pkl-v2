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

    public function pinjamuser(){
        $barang = Barang ::all();
        return view('user\pinjamuser' , compact('barang'));
        return redirect(route('history'));
    }

    public function store(request $request){
        if($request->image){
            $img =  $request->get('image');
            $folderPath = "images/";
            $image_parts = explode(";base64,", $img);
            foreach ($image_parts as $row => $image){
            $image_base64 = base64_decode($image);
            }
            $fileName = uniqid() . '.png';
            $file = $folderPath . $fileName;
            file_put_contents($file, $image_base64);
            $validateData['image'] = $fileName;
            // dd($fileName);
            $id = auth()->user()->nim;
            $nama = auth()->user()->name;
            $data = Peminjam::insert([
                'nama_barang' => $request->nama_barang,
                'image' => $fileName,
                'nama' => $nama,
                'nim' => $id,
                'jumlah' =>$request->jumlah,
                'expired_at' => Carbon::today()->addWeeks(1)->toDateString(),
                'created_at' => now(),
            ]);
            // dd($data);
        }  
            
        return redirect(route('history'));
    }
}
