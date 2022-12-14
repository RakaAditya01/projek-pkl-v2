<?php

namespace App\Http\Controllers;

use App\Models\Peminjam;
use Alert;
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
        
        $nim = auth()->user()->nim;
        // $peminjam = DB::table('users')
        //     ->join('peminjams', 'peminjams.nim','=','users.nim')
        //     ->select('users.*','peminjams.nama_barang','peminjams.jumlah')
        //     ->get()
        // ;
        // dd($peminjam);
        $user = DB::table('users')
            ->where('nim' ,'=', $nim)
            ->select('nim','name')
            ->get();
        // 

        // dd($user);
         return view('Peminjaman\tambahpeminjam',[
            'user' => $user
         ] , compact('barang'));
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
                'keterangan' =>$request->keterangan,
                'jumlah' =>$request->jumlah,
                'expired_at' => Carbon::today()->addWeeks(1)->toDateString(),
                'created_at' => now(),
            ]);
        }  
            
        return redirect('peminjaman')->with('toast_success', 'Data Berhasil Di Simpan!');;
    }
    

    public function tampilanpeminjam($id){
        $data = DB::table('peminjams')->where('id',$id)->find($id);
    return view('Peminjaman\edit',['data'=>$data]);
    }

    public function update(request $request, $id){  
        $data = DB::table('peminjams')->where('id',$id)->get()[0];

        $data = DB::table('peminjams')
        ->where('id', $id)
         // dd($fileName);
          ->update([
           'nama_barang' => $request->nama_barang,
                'keterangan' =>$request->keterangan,
                'jumlah' =>$request->jumlah,
                'expired_at' => Carbon::today()->addWeeks(1)->toDateString(),
                'created_at' => now(),
      ]);

if($request->images){
  if($data->image){
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
  $data = DB::table('peminjams')
        ->where('id', $id)
        ->update([
          'image' => $fileName,
          'nama_barang' => $request->nama_barang,
          'keterangan' =>$request->keterangan,
          'jumlah' =>$request->jumlah,
          'expired_at' => Carbon::today()->addWeeks(1)->toDateString(),
          'created_at' => now(),
      ]);
}
return redirect()->route('peminjam')->with('toast_success', 'Data Berhasil Di Edit!');;  
    }   

    public function destroy(request $request,$id){
        $data = Peminjam::find($id);
        $data->delete();
        return redirect()->route('peminjaman')->with('toast_success', 'Data Berhasil Di Hapus!');;;
    }
}
