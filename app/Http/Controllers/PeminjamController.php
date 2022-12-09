<?php

namespace App\Http\Controllers;

use App\Models\Peminjam;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PeminjamController extends Controller
{
    public function index(){  
        $data = Peminjam::paginate();
        
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
        $data = Peminjam::create ($request->all());
        if($request->hasFile('dokumentasi')){
           $data->dokumentasi = cloudinary()->upload($request->file('dokumentasi')->getRealPath())->getSecurePath();
        //    dd($data);
           $data->save();
        }  
            
        return redirect(route('peminjaman'));
    }
    

    public function tampilanpeminjam($id){
        $data = Peminjam::find($id);
        return view('Peminjaman\edit',compact('data'));
    }

    public function update(request $request, $id){  
        $data = Peminjam::find($id);
        $data->update($request->all());
        return redirect()->route('peminjaman')->with('success', 'Data Berhasil Di Edit!');;
    }   

    public function destroy(request $request,$id){
        $data = Peminjam::find($id);
        $data->delete();
        return redirect()->route('peminjaman');
    }
}
