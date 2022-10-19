<?php

namespace App\Http\Controllers;

use App\Models\Peminjam;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamController extends Controller
{
    public function index(){  
        $data = Peminjam::paginate();
        
        // 
        return view('Peminjaman\peminjaman',compact('data'));
    }

    public function tambahpeminjam(Request $request){
        $barang = Barang ::all();
        
        $nama = auth()->user()->name;
        // $peminjam = DB::table('users')
        //     ->join('peminjams', 'peminjams.nim','=','users.nim')
        //     ->select('users.*','peminjams.nama_barang','peminjams.jumlah')
        //     ->get()
        // ;
        // dd($peminjam);
        $user = DB::table('users')
            ->where('name' ,'=', $nama)
            ->select('nim','name')
            ->get();
        // 
         return view('Peminjaman\tambahpeminjam',[
            'user' => $user
         ] , compact('barang'));
    }

    public function store(request $request){
        $this-> validate($request, [
            'nim',
            'nama',
            'nama_barang'=> 'required',
            'dokumentasi'=> 'required',
            'jumlah'=> 'required',
        ],
        [
            'nama_barang.required' => 'Nama Barang tidak boleh kosong',
            'dokumentasi.required' => 'Dokumentasi tidak boleh kosong',
            'jumlah.required' => 'Jumlah tidak boleh kosong',
        ]);
        // $datas[] =[
        //     'nim' => $request->input('nim'),
        //     'nama' => $request->input('nama'),
        //     'nama_barang' => $request->input('nama_barang'),
        //     'dokumentasi' => $request()->file('dokumentasi'),
        //     'jumlah' => $request->input('jumlah')
        // ];
        // dd($datas);
        $data = Peminjam::create ($request->all());
        if($request->hasFile('dokumentasi')){
            $request->file('dokumentasi')->move('fotodokumentasi/', $request->file('dokumentasi')->getClientOriginalName());
            $data->dokumentasi = $request->file('dokumentasi')->getClientOriginalName();
            $data->save();
        }  
            
        return redirect(route('peminjaman'));
    }
    

    public function tampilanpeminjam($id){
        $data = Peminjam::find ($id);
        return view('Peminjaman\edit',compact('data'));
    }

    public function update(request $request, $id){  
        $data = Peminjam::find($id);
        $data->update($request->all());
        return redirect()->route('peminjaman')->with('success', 'Data Berhasil Di Edit!');;
    }   

    public function destroy($id){
        $data = Peminjam::first();
        $data->delete();
        return redirect()->route('peminjaman');
    }
}
