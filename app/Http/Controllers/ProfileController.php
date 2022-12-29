<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index(){
        $data = User::paginate();
        return view('features-profile',compact('data'));
    }
    
    public function update(Request $request){
        $request -> validate([
            'aboutme' => ['string', 'max:300']
        ]);
        $user = User::query()
                ->where('nim',$request->nim)
                ->update(['aboutme' => $request->aboutme]);
        return back()->with('message', 'Your profile has been update');
    }
}
