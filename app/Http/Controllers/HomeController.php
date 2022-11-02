<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\User;
use App\Models\Peminjam;
use DB;

class HomeController extends Controller
{
    public function index(){
        $barang = Barang::count();
        $peminjam = Peminjam::count();
        $user = User::count();
        return view('pages.dashboard-general-dashboard', compact('barang','peminjam', 'user'));
    }
}
