<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
class ErorController extends Controller{
 
	public function index($nama){
		if($nama == "dashboard-general-dashboard"){
			return abort(403,'Anda tidak punya akses karena anda Malas Ngoding');
		}elseif($nama == "diki"){
			return "Halo, ".$nama;
		}else{
			return abort(404);
		}
	}
 
}