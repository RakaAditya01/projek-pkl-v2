<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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
            'gambar' => 'required',
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
        $data = Barang::create ($request->all());
        if($request->hasFile('gambar')){
            $request->file('gambar')->move('fotodokumentasi/', $request->file('gambar')->getClientOriginalName());
            $data->gambar = $request->file('gambar')->getClientOriginalName();
            $data->save();
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
    return redirect()->route('barang')->with('success', 'Data Berhasil Di Edit!');;
    }   

    public function destroy($id){
    $data = Barang::find($id);
    $data->delete();
    return redirect()->route('barang')->with('success', 'Data Berhasil Di Hapus!');;
    }
}
