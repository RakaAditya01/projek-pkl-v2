<?php

namespace App\Exports;

use App\Models\Peminjam;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView; 

class PeminjamExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view():View
    {
        return view('excel1', [
            'data' => Peminjam::all()
        ]);
    }
}
