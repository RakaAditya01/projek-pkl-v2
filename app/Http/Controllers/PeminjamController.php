<?php namespace App\Http\Controllers;

use App\Models\Peminjam;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Exports\PeminjamExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Constraint\IsEmpty;
use PDF;


class PeminjamController extends Controller {
    public function index() {
        $data=Peminjam::paginate(9999999999);
        return view('Peminjaman.peminjaman', compact('data'));
    }

    public function exportPDF() {
        $data = Peminjam::all();
        $PdfPeminjam = PDF::loadView('PdfPeminjam', ['data' => $data]);
        return $PdfPeminjam->stream('peminjam.PdfPeminjam');
    }

    public function excel1()
	{
		return Excel::download(new PeminjamExport, 'HISTORY-PEMINJAMAN.xlsx');
	}

    public function tambahpeminjam(Request $request) {
        $barang=Barang::all();
        $nama=auth()->user()->name;
        $user=DB::table('users') ->where('name', '=', $nama) ->select('nim', 'name') ->get();
        return view('Peminjaman.tambahpeminjam', [ 'user'=> $user], compact('barang'));
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
            $data=Peminjam::insert([ 
                'nama_barang'=> $request->nama_barang,
                'image'=> $upload,
                'nama'=> $nama,
                'nim'=> $id,
                'keterangan'=>$request->keterangan,
                'jumlah'=>$request->jumlah,
                'kepemilikan'=>$request->kepemilikan,
                'expired_at'=> Carbon::today()->addWeeks(1)->toDateString(),
                'created_at'=> now(),
                ]);
        }
        return redirect(route('peminjaman'));
    }


    // public function grafik()
    // {
    //     $jumlah = Peminjam::select(DB::raw("CAST(SUM(jumlah) as int) as jumlah"))
    //     ->groupBy(DB::raw("Month(created_at)"))
    //     ->pluck('jumlah');
        

    //     $bulan = Peminjam::select(DB::raw("MONTHNAME(created_at) as bulan"))
    //     ->groupBy(DB::raw("MONTHNAME(created_at)"))
    //     ->pluck('bulan');

    //     return view('grafik', compact('jumlah', 'bulan'));
    // }

    public function tampilanpeminjam($id) {
        $data=DB::table('peminjams')->where('id', $id)->find($id);
        return view('Peminjaman.edit', ['data'=>$data]);
    }

    public function update(request $request, $id) {
        $jumlah_peminjam= DB::table('peminjams')
                ->select('jumlah')
                ->where('id', $id)
                ->first();
                
                // $test = json_decode(json_encode($jumlah_peminjam), true);
                // $jumlah_peminjam = $test['jumlah'];
                // $jumlah_kurang = $request->jumlah;
                // $total = $jumlah_peminjam - $jumlah_kurang;
                // $jumlah_akhir = DB::table('barangs')
                // ->select('stock')
                // ->where('id', $id)
                // ->first();
                // $test2 = json_decode(json_encode($jumlah_akhir), true);
                // $jumlah_akhir = $test2['stock']; 
                // $total_akhir = $jumlah_akhir + $total;
        
        $data=DB::table('peminjams') ->where('id', $id) // dd($fileName);
            ->update([ 'nama_barang'=> $request->nama_barang,
                'keterangan'=>$request->keterangan,
                'jumlah'=>$request->jumlah,
                'expired_at'=> Carbon::today()->addWeeks(1)->toDateString(),
                'created_at'=> now(),
                ]);

        // $barang_update=DB::table('barangs') ->where('id', $id) // dd($fileName);
        //     ->update([ 
        //         'stock'=>$total_akhir,
        //         ]);

                
            $this->validate($request, [
            'nama_barang'=> 'required',
            'jumlah'=> 'required',
            ],
            [
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
            
                // $jumlah = DB::table('barangs')
                // ->select('jumlah')
                // ->get();
                // dd($jumlah);
        }
        return redirect()->route('peminjaman')->with('toast_success', 'Data Berhasil Di Edit!');
    }

    public function destroy($id){
        $data = Peminjam::find($id);
        $data->delete();
        return redirect()->route('peminjaman')->with('toast_success', 'Data Berhasil Di Hapus!');
        }

}
