<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Peminjam;
use DB;

class HomeController extends Controller
{
    public function index(){
        $barang = Barang::count();
        $peminjam = Peminjam::count();
        return view('dashboard-general-dashboard', compact('barang','peminjam'));
    }
}
