<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Peminjam;
use Illuminate\Http\Request;

class HistorybarangController extends Controller
{
    public function index(){
        $data = History::paginate(9999999999);
        // dd($data);
        return view('History.history-barang-user',compact('data'));
    }

    public function tampilhistory($id){
        $data = Peminjam::find($id);
        return redirect()->route('history-barang-user')->with('toast_success', 'Data Berhasil Di Hapus!');;
    }

    public function destroy($id){
        $data = History::find($id);
        $data->delete();
        return redirect()->route('history-barang-user')->with('toast_success', 'Data Berhasil Di Hapus!');;
        }
}
