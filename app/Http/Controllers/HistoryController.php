<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjam;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(){
        $data = Peminjam::paginate();
        return view('user\history',compact('data'));
    }

    public function destroy($id){
        $data = Peminjam::find($id);
        $data->delete();
        return redirect()->route('history');
    }
}
