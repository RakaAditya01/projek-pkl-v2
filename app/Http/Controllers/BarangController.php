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
        // $data = Barang::create ($reque;
        if($request->images){
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
            
            $data = Barang::insert([
                'nama_barang' => $request->nama_barang,
                'stock' => $request->stock,
                'anggaran' => $request->anggaran,
                'scan' => $request->scan,
                'image' => $fileName,
                'created_at' => now(),
            ]);
            // $data->nama_barang = $request->nama_barang;
            // $data->stock = $request->stock;
            // $data->anggaran = $request->anggaran;
            // $data->scan = $request->scan;
            // $data->image = $fileName;
            // dd($data);
            // $data->save();
            
        }
        

        return redirect(route('barang'));
    }
    
    

    public function tampilanbarang($id){
        $data = DB::table('barangs')->where('id',$id)->find($id);
    return view('Barang\edit',['data'=>$data]);
   }
   public function update(request $request, $id)
   {
    $data = DB::table('barangs')->where('id',$id)->get()[0];

    //     'nama_barang' => $request->nama_barang,
    //     'stock' => $request->stock,
    //     'anggaran' => $request->anggaran,
    //     'scan' => $request->scan,
    //     'image' => $fileName,
    //     'created_at' => now(),
    // ]);
    $data = DB::table('barangs')
              ->where('id', $id)
              ->update([
                'nama_barang' => $request->nama_barang,
                'stock' => $request->stock,
                'anggaran' => $request->anggaran,
                'scan' => $request->scan,
                'updated_at' => now(),
            ]);

    if($request->images){
        if($data->images){
            File::delete('images/'. $data->image);
        }
        $img =  $request->get('image');
        $folderPath = "images/";
        $image_parts = explode(";base64,", $img);
        foreach ($image_parts as $key => $image){
            $image_base64 = base64_decode($image);
        }
        $fileName = uniqid() . '.png';
        $file = $folderPath . $fileName;
        file_put_contents($file, $image_base64);
        $validateData['image'] = $fileName;
        $data = DB::table('barangs')
              ->where('id', $id)
              ->update([
                'image' => $fileName,
                'nama_barang' => $request->nama_barang,
                'stock' => $request->stock,
                'anggaran' => $request->anggaran,
                'scan' => $request->scan,
                'updated_at' => now(),
            ]);
    }
    
    return redirect()->route('barang')->with('success', 'Data Berhasil Di Edit!');;
    }   

    public function destroy($id){
    $data = Barang::find($id);
    $data->delete();
    return redirect()->route('barang')->with('success', 'Data Berhasil Di Edit!');;
    }   
}
