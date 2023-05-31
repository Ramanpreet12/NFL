<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prize;
use App\Models\Season;
use App\Http\Requests\PrizeRequest;


class PrizeController extends Controller
{
    //
    public function index(){
        $prizes = Prize::with('season')->get();
        return view('backend.prize.index' , compact('prizes'));
    }

    public function create(){
        $seasons = Season::get();
        return view('backend.prize.create' , compact('seasons'));
    }
    public function store(PrizeRequest $request){

        try{
           if ($request->isMethod('post')) {
               $input = $request->all();
               if ($request->hasFile('image')) {
                $image_file = $request->file('image');
                $image_filename = $image_file->getClientOriginalName();
                $image_file->storeAs('public/images/prize/' , $image_filename);
                $input['image'] = $image_filename;
        }

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

    public function update(PrizeRequest $request, $id){
        // try{
            if ($request->isMethod('put')) {
                $data = array();

                    $image_file     =   $request->file('image');
                    if ($image_file) {
                        $image_filename = $image_file->getClientOriginalName();
                        $success = $image_file->storeAs('public/images/prize/' , $image_filename);
                        if (!isset($success)) {
                            return back()->withError('Could not upload logo');
                        }
                        $data["image"]=$image_filename;
                    }


                    $data["season_id"]=$request->season_id;
                    $data["name"]=$request->name;
                    $data["amount"]=$request->amount;
                    $data["content"]=$request->content;
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
