<?php namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjam;
use Alert;
use PDF;
use Illuminate\Http\Request;
use App\Exports\BarangExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Constraint\IsEmpty;


class BarangController extends Controller
{

    public function index(){
        $data = Barang::paginate(9999999999);
        // dd($data);
        return view('Barang.barang',compact('data'));
    }

    public function excel()
	{
		return Excel::download(new BarangExport, 'DATA-BARANG.xlsx');
	}

    public function exportPDF() {
        $data = Barang::all();
        $pdf = PDF::loadView('pdf', ['data' => $data]);
        return $pdf->stream('barang.pdf');
    }
    public function cetakpdf() {
        $data = Barang::all();
        $pdf = PDF::loadView('pdf1', ['data' => $data]);
        return $pdf->stream('barang.pdf1');
    }

    public function tambahbarang(){
        $data = Barang::all();
        return view('Barang.tambahbarang' , compact('data'));
    }

    public function store(request $request) {
        $this->validate($request, [ 'nama_barang'=> 'required',
            'stock'=> 'required',
            'anggaran'=> 'required',
            // 'scan'=> 'required',
            ],
            [ 'gambar.required'=> 'Gambar tidak boleh kosong',
            'nama_barang.required'=> 'Nama Barang tidak boleh kosong',
            'stock.required'=> 'Stock tidak boleh kosong',
            'anggaran.required'=> 'Anggaran tidak boleh kosong',
            ]);
        // $data = Barang::create ($reque;
        if($request->get('image')) {
            $empty = "";
            $img=$request->get('image');
            $image_parts=explode(";base64,", $img);
            foreach ($image_parts as $row=> $image) {
                $image_base64=base64_decode($image);
            }
            // dd($fileName);
            $upload=cloudinary()->upload($img)->getSecurePath();
            if($request->scan == $empty || $request->serialnumber == $empty){
                $id = $this->generateIdCode();
                $random = $this->generateUniqueCode();
                $serial = $this->generateSerialNumber($id);
                // dd($serial);
                $data = Barang::insert([
                'nama_barang' => $request->nama_barang,
                'stock' => $request->stock,
                'anggaran' => $request->anggaran,
                'scan' => $random,
                'serialnumber' => $serial,
                'kepemilikan' => $request->kepemilikan,
                'image' => $upload,
                'created_at' => now(),
                ]);
            } else {
                $data = Barang::insert([
                    'nama_barang' => $request->nama_barang,
                    'stock' => $request->stock,
                    'anggaran' => $request->anggaran,
                    'scan' => $request->scan,
                    'serialnumber' => $request->serialnumber,
                    'kepemilikan' => $request->kepemilikan,
                    'image' => $upload,
                    'created_at' => now(),
                ]);
            }
        }
        return redirect('barang')->with('toast_success', 'Data Berhasil Di Simpan!');
    }

    public function tampilanbarang($id) {
        $data=DB::table('barangs')->where('id', $id)->find($id);
        return view('Barang.edit', ['data'=>$data]);
    }

    public function update(request $request, $id) {
        $data=DB::table('barangs')->where('id', $id)->get()[0];
        $data=DB::table('barangs') ->where('id', $id) ->update([ 'nama_barang'=> $request->nama_barang,
                'stock'=> $request->stock,
                'anggaran'=> $request->anggaran,
                'scan'=> $request->scan,
                'serialnumber'=> $request->serialnumber,
                'kepemilikan' => $request->kepemilikan,
                'updated_at'=> now(),
                ]);
        if($request->get('image')) {
            $img=$request->get('image');
            $image_parts=explode(";base64,", $img);
            foreach ($image_parts as $key=> $image) {
                $image_base64=base64_decode($image);
            }
            $upload=cloudinary()->upload($img)->getSecurePath();
            // dd($upload);
            $data=DB::table('barangs') ->where('id', $id) ->update([ 'image'=> $upload,
                ]);
        }
        return redirect('barang')->with('toast_success', 'Data Berhasil Di Edit!');
    }   

    public function destroy($id){
    $data = Barang::find($id);
    $data->delete();
    return redirect()->route('barang')->with('toast_success', 'Data Berhasil Di Hapus!');;
    }

    public function generateUniqueCode()
    {
        do {
            $code = random_int(10000000, 99999999);
        } while (Barang::where("scan", "=", $code)->first());
        return $code;
    }

    public function generateIdCode()
    {
        do {
            $code = random_int(1000, 9999);
        } while (Barang::where("serialnumber", "=", $code)->first());
        return $code;
    }

    public static function generateSerialNumber(int $id)
        {
            $start = 0; // 0 = A, 702 or 703 = AAA, adjust accordingly
            $letters_value = $start + (ceil($id / 999) - 1);
            $numbers = ($id % 999 === 0) ? 999 : $id % 999;

            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $base = strlen($characters);
            $letters = '';

            // while there are still positive integers to divide
            while ($letters_value) {
                $current = $letters_value % $base;
                $letters = $characters[$current] . $letters;
                $letters_value = floor($letters_value / $base);
            }

        return $letters.'-'.sprintf('%03d', $numbers);
        }
}