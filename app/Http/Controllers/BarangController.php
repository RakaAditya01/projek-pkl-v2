<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjam;
use File;
use Illuminate\Http\Request;
use App\Exports\DataExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class BarangController extends Controller
{
    public function index(){
        $data = Barang::paginate();
        return view('Barang.barang',compact('data'));
    }

    public function tambahbarang(){
        $data = Barang::all();
        return view('Barang\tambahbarang' , compact('data'));
    }

    public function store(request $request){
        $this-> validate($request, [
            'nama_barang' => 'required',
            'stock' => 'required',
            'anggaran' => 'required',
            'scan' => 'required',
        ],
        [
            'gambar.required' => 'Gambar tidak boleh kosong',
            'nama_barang.required' => 'Nama Barang tidak boleh kosong',
            'stock.required' => 'Stock tidak boleh kosong',
            'anggaran.required' => 'Anggaran tidak boleh kosong',
        ]);
        if($request->image){
            $img =  $request->put('image');
            $folderPath = "storage/";
            $image_parts = explode(";base64,", $img);
            foreach ($image_parts as $row => $image){
            $image_base64 = base64_decode($image);
            }
            $fileName = uniqid() . '.png';
            $file = $folderPath . $fileName;
            file_put_contents($file, $image_base64);
            $validateData['image'] = $fileName;
        }

        return redirect(route('barang'));
    }
    
    

    public function tampilanbarang($id){
        $data = Barang::find ($id);
    return view('Barang\edit',compact('data'));
   }
   public function update(request $request, $id){
    $data = Barang::find($id);
    $data->update($request->all());

    if($request->image){
        if($data->image){
            File::delete('storage/'. $data->image);
        }
        $img =  $request->get('image');
        $folderPath = "storage/";
        $image_parts = explode(";base64,", $img);
        foreach ($image_parts as $key => $image){
            $image_base64 = base64_decode($image);
        }
        $fileName = uniqid() . '.png';
        $file = $folderPath . $fileName;
        file_put_contents($file, $image_base64);
        $validateData['image'] = $fileName;
    }
    return redirect()->route('barang')->with('success', 'Data Berhasil Di Edit!');;
    }   

    public function destroy($id){
    $data = Barang::find($id);
    $data->delete();
    return redirect()->route('barang')->with('success', 'Data Berhasil Di Edit!');;
    }   
}
