<?php
  
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Models\Peminjam;
use DB;
    
class ChartJSController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $peminjams = Peminjam::select(DB::raw("COUNT(*) as count"), DB::raw("DAYNAME(created_at) as day_name"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(DB::raw("day_name"))
                    ->orderBy('id','ASC')
                    ->pluck('count', 'day_name');
 
        $labels = $peminjams->keys();
        $data = $peminjams->values();
              
        return view('chart', compact('labels', 'data'));
    }
}