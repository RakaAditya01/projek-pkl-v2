<?php namespace App\Http\Controllers;

use App\Models\Peminjam;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;


class PeminjamController extends Controller {
    public function index() {
        $data=Peminjam::paginate(10);

        return view('Peminjaman\peminjaman', compact('data'));
    }

    public function tambahpeminjam(Request $request) {
        $barang=Barang::all();

        $nama=auth()->user()->name;
        // $peminjam = DB::table('users')
        //     ->join('peminjams', 'peminjams.nim','=','users.nim')
        //     ->select('users.*','peminjams.nama_barang','peminjams.jumlah')
        //     ->get()
        // ;
        // dd($peminjam);
        $user=DB::table('users') ->where('name', '=', $nama) ->select('nim', 'name') ->get();
        // 
        return view('Peminjaman\tambahpeminjam', [ 'user'=> $user], compact('barang'));
    }

    public function store(request $request) {
        $this->validate($request, [ 'image'=> 'required',
            'nama_barang'=> 'required',
            'jumlah'=> 'required',
            ],
            [ 'image.required'=> 'Gambar tidak boleh kosong',
            'nama_barang.required'=> 'Nama Barang tidak boleh kosong',
            'jumlah.required'=> 'Jumlah Tidak Boleh Kosong'
            ]);

        if ($request->get('image')) {
            $img=$request->get('image');
            $image_parts=explode(";base64,", $img);
            foreach ($image_parts as $row=> $image) {
                $image_base64=base64_decode($image);
            }
            $upload=cloudinary()->upload($img)->getSecurePath();
            $id=auth()->user()->nim;
            $nama=auth()->user()->name;
            $data=Peminjam::insert([ 'nama_barang'=> $request->nama_barang,
                'image'=> $upload,
                'nama'=> $nama,
                'nim'=> $id,
                'keterangan'=>$request->keterangan,
                'jumlah'=>$request->jumlah,
                'expired_at'=> Carbon::today()->addWeeks(1)->toDateString(),
                'created_at'=> now(),
                ]);
        }

        return redirect(route('peminjaman'));
    }

    public function tampilanpeminjam($id) {
        $data=DB::table('peminjams')->where('id', $id)->find($id);
        return view('Peminjaman\edit', ['data'=>$data]);
    }

    public function update(request $request, $id) {
        $data=DB::table('peminjams') ->where('id', $id) // dd($fileName);
            ->update([ 'nama_barang'=> $request->nama_barang,
                'keterangan'=>$request->keterangan,
                'jumlah'=>$request->jumlah,
                'expired_at'=> Carbon::today()->addWeeks(1)->toDateString(),
                'created_at'=> now(),
                ]);
            $this->validate($request, [ 'image'=> 'required',
            'nama_barang'=> 'required',
            'jumlah'=> 'required',
            ],
            [ 'image.required'=> 'Gambar tidak boleh kosong',
            'nama_barang.required'=> 'Nama Barang tidak boleh kosong',
            'jumlah.required'=> 'Jumlah Tidak Boleh Kosong'
            ]);

        if($request->get('image')) {
            $img=$request->get('image');
            $image_parts=explode(";base64,", $img);
            foreach ($image_parts as $key=> $image) {
                $image_base64=base64_decode($image);
            }
            $upload= cloudinary()->upload($img)->getSecurePath();
            $data=DB::table('peminjams') ->where('id', $id) ->update([ 'image'=> $upload,
                'nama_barang'=> $request->nama_barang,
                'keterangan'=>$request->keterangan,
                'jumlah'=>$request->jumlah,
                'expired_at'=> Carbon::today()->addWeeks(1)->toDateString(),
                'created_at'=> now(),
                ]);
        }

        return redirect()->route('peminjaman')->with('toast_success', 'Data Berhasil Di Edit!');
        ;
    }

    public function destroy($id){
        $data = Peminjam::find($id);
        $data->delete();
        return redirect()->route('peminjaman')->with('toast_success', 'Data Berhasil Di Hapus!');;
        }   
}
