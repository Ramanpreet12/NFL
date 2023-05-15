<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prize;
use App\Models\Season;

class PrizeController extends Controller
{
    //
    public function index(){
        $prizes = Prize::get();
        return view('backend.prize.index' , compact('prizes'));
    }

    public function create(){
        $seasons = Season::get();
        return view('backend.prize.create' , compact('seasons'));
    }
    public function store(Request $request){

        try{
           if ($request->isMethod('post')) {
               $input = $request->all();
               $prize = Prize::create($input);
               if($prize){
                   return redirect()->route('prize.index')->with('success_msg', 'Prize created successfully');
               }
               else{
                   return redirect()->route('prize.index')->with('error_msg', 'Something went wrong');
               }

           }
       }catch(\Exception $e){
           $e->getMessage();
       }
   }


    // public function list(){
    //     $prize = Prize::paginate(6);
    //     return response()->json($prize, 200);
    // }

    public function edit($id){
        $seasons = Season::get();
        $prize = Prize::find($id);
        // dd($prize);
        return view('backend.prize.edit', compact('seasons' , 'prize'));
    }

    public function update(Request $request, $id){
        // try{
            if ($request->isMethod('put')) {
                $data = array();


                    $data["season_id"]=$request->season_id;
                    $data["name"]=$request->name;
                    $data["amount"]=$request->amount;
                    $data["status"]=$request->status;
                    $prize=Prize::where('id',$id)->update($data);
                    if($prize){
                        return redirect()->route('prize.index')->with('success_msg', 'Prize updated successfully');
                    }
                    else{
                        return redirect()->route('prize.index')->with('error_msg', 'Something went wrong');
                    }
                }
            // }catch(\Exception $e){
            //     $e->getMessage();
            // }

    }


    public function destroy($id){
        $prize =  Prize::find($id)->delete();
        if($prize){
         return redirect()->route('prize.index')->with('success_msg', 'Prize deleted successfully');
        }else{
         return redirect()->route('prize.index')->with('error_msg', 'Something went wrong');
        }
     }
}
