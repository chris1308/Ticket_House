<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjual;
class PenjualController extends Controller
{
    public function upgrade($id){
        Penjual::where('id_penjual',$id)->update(["premium_status"=>1]);
        $penjual = Penjual::where('id_penjual',$id)->first();
        //update session so that the membership status on the sidebar will be updated
        session(['user'=>$penjual]);
        
        return redirect('/dashboard');
    }
}
