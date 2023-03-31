<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prize;

class PrizeController extends Controller
{
    //
    public function index(){
        return view('backend.prize.index');
    }

    public function list(){        
        $prize = Prize::paginate(6);        
        return response()->json($prize, 200); 
    }

    public function edit($id){
        return $id;
    }

    public function delete($id){
        $prize = Prize::find($id)->delete();
        if($prize){
            return redirect()->back()->with('message_success','Prize deleted successfully');
        }else{
            return redirect()->back()->with('message_error','SOmething went wrong');
        }
    }
}
